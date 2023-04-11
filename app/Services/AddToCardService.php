<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductInfo\Product;
use App\Models\FrontEnd\AddToCard as AddToCardModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AddToCardService extends Controller
{
    /**
     * @var Product
     */
    private $product;
    /**
     * @var AddToCardModel
     */
    private $addToCardModel;

    /**
     * AddToCard constructor.
     */
    public function __construct(Product $product, AddToCardModel $addToCardModel)
    {
        $this->product = $product;
        $this->addToCardModel = $addToCardModel;
    }

    public static function addCardStore($productId, $quantity = 1): array
    {
        $sessionId = Session::getId();
        $result = Product::with('ProductImageFirst')->find($productId);

        if ($result) {
            $product = $result->toArray();
            $productImage = isset($product['product_image_first']['image']) ? $product['product_image_first']['image'] : '';
            $productInfo = [
                'product_id' => $product['id'],
                'product_name' => $product['name'],
                'regular_price' => $product['regular_price'],
                'special_price' => $product['special_price'],
                'wholesale_price' => $product['wholesale_price'],
                'image' => $productImage ? $productImage : 'blank-product-image.png',
            ];

            $productCard = AddToCardModel::where(['session_id' => $sessionId, 'product_id' => $productId])->with('getProduct')->first();

            if ($productCard) {
                if ($quantity == 0) {
                    $requestQuantity = ($productCard->quantity + $quantity);
                } elseif ($quantity == 1) {
                    $requestQuantity = 1;
                } elseif ($quantity > 1) {
                    $requestQuantity = $quantity;
                } else {
                    $requestQuantity = 0;
                }

                //if(! ($requestQuantity >= $productCard['getProduct']['min_order_qty'])){
                if (!($requestQuantity >= $result['min_order_qty'])) {
                    return [
                        'errorStatus' => true,
                        'message' => 'Sorry sir, minimum order quantity '.$result['min_order_qty'].'',
                        'data' => [
                            'quantity' => $result['min_order_qty'],
                        ],
                        'errors' => [
                            'error' => '',
                        ],
                    ];
                }

                if (!$quantity) {
                    return [
                        'errorStatus' => true,
                        'message' => 'Sorry sir, 0 quantity is not accepted!.',
                        'data' => [
                            'quantity' => 1,
                        ],
                        'errors' => [
                            'error' => '',
                        ],
                    ];
                }

                if ($requestQuantity > 0) {
                    $productCard->quantity = $requestQuantity;
                    $productCard->data = json_encode($productInfo);
                    if (Auth::user()) {
                        if ($product['special_price']) {
                            $productCard->unit_price = $product['special_price'];
                        } else {
                            $productCard->unit_price = $product['regular_price'];
                        }
                        $productCard->total_price = ($productCard->quantity * $productCard->unit_price);
                    } else {
                        if ($product['special_price']) {
                            $productCard->unit_price = $product['special_price'];
                        } else {
                            $productCard->unit_price = $product['regular_price'];
                        }
                        $productCard->total_price = ($productCard->quantity * $productCard->unit_price);
                    }
                }
            } else {
                $productCard = new AddToCardModel();
                $productCard->session_id = $sessionId;
                $productCard->product_id = $productId;
                $productCard->data = json_encode($productInfo);
                $productCard->quantity = $quantity;
                if (Auth::user()) {
                    if (Auth::user()->Contact->contact_type == 'Wholesale') {
                        $productCard->unit_price = $product['wholesale_price'];
                        $productCard->total_price = ($productCard->quantity * $product['wholesale_price']);
                    } else {
                        if ($product['special_price'] > 0) {
                            $productCard->unit_price = $product['special_price'];
                            $productCard->total_price = ($productCard->quantity * $product['special_price']);
                        } else {
                            $productCard->unit_price = $product['regular_price'];
                            $productCard->total_price = ($productCard->quantity * $product['regular_price']);
                        }
                    }
                } else {
                    $productCard->unit_price = $product['regular_price'];
                    $productCard->total_price = ($productCard->quantity * $product['regular_price']);
                }
            }

            $productCard->save();

            $card = self::cardTotalProductAndAmount();
            $data['product_card'] = $productCard->toArray();
            $data['total_price'] = $card['data']['total_price'];
            $data['number_of_product'] = $card['data']['number_of_product'];

            $response = [
                'errorStatus' => false,
                'message' => '',
                'data' => $data,
                'errors' => [
                    'error' => '',
                ],
            ];
        } else {
            $response = [
                'errorStatus' => true,
                'message' => 'Invalid product',
                'data' => [],
                'errors' => [
                    'error' => '',
                ],
            ];
        }

        return $response;
    }

    public static function cardTotalProductAndAmount()
    {
        $sessionId = Session::getId();

        $results = AddToCardModel::where('session_id', $sessionId)
            ->select(['product_id', 'quantity', 'unit_price', 'data', 'total_price'])
            ->with('getProduct')
            ->get()->toArray();

        $data['total_price'] = 0;
        $data['number_of_product'] = 0;
        $data['products'] = [];
        //$data['miniCard'] = '';
        //$data['miniCard'] = self::miniCard();

        foreach ($results as $result) {
            $data['total_price'] += $result['total_price'];
            ++$data['number_of_product'];
            $data['products'][$result['product_id']] = [
                'Info' => json_decode($result['data'], true),
                'product_id' => $result['product_id'],
                'quantity' => $result['quantity'],
                'minimum_order_quantity' => $result['get_product']['min_order_qty'],
                'unit_price' => $result['unit_price'],
                'total_price' => $result['total_price'],
            ];
        }

        $response = [
            'errorStatus' => false,
            'message' => '',
            'data' => $data,
            'errors' => [
                'error' => '',
            ],
        ];

        return $response;
    }

    public static function miniCard()
    {
        return view('frontend.header-card-popup')->render();
    }

    public static function productDelete($productId)
    {
        $sessionId = Session::getId();

        $result = AddToCardModel::where(['session_id' => $sessionId, 'product_id' => $productId])->delete();

        if ($result) {
            $data = self::cardTotalProductAndAmount();
            $response = [
                'errorStatus' => false,
                'message' => '',
                'data' => $data,
                'errors' => [
                    'error' => '',
                ],
            ];
        } else {
            $response = [
                'errorStatus' => true,
                'message' => 'Product delete not successful',
                'data' => [],
                'errors' => [
                    'error' => '',
                ],
            ];
        }

        return $response;
    }
}
