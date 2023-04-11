<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile\PermissionCategories;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'seller']);
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'editor']);
        Role::create(['name' => 'manager']);

        $users = User::all();
        foreach ($users as $user) {
            $user->assignRole('admin');
        }

        $permissionLists = [

            [
                'name' => "user",
                'title' => "User Management"
            ],
            [
                'name' => "processing_order",
                'title' => "Processing Order"
            ],
            [
                'name' => "shipped_order",
                'title' => "Shipped Order"
            ],
            [
                'name' => "delivered_order",
                'title' => "Delivered Order"
            ],
            [
                'name' => "returned_order",
                'title' => "Returned Order"
            ],
            [
                'name' => "all_order",
                'title' => "All Order"
            ],
            [
                'name' => "product",
                'title' => "Product"
            ],
            [
                'name' => "category",
                'title' => "Category"
            ],
            [
                'name' => "brand",
                'title' => "Brand"
            ],
            [
                'name' => "unit",
                'title' => "Unit"
            ],
            [
                'name' => "branch",
                'title' => "Branch"
            ],
            [
                'name' => "vat",
                'title' => "Vat"
            ],
            [
                'name' => "shipping_charge",
                'title' => "Shipping Charge"
            ],
            [
                'name' => "warehouse",
                'title' => "Warehouse"
            ],
            [
                'name' => "company_info",
                'title' => "Company Info"
            ],
            [
                'name' => "currency",
                'title' => "Currency"
            ],
            [
                'name' => "delivery_method",
                'title' => "Delivery Method"
            ],
            [
                'name' => "invoice_setting",
                'title' => "Invoice Setting"
            ],
            [
                'name' => "payment_method",
                'title' => "Payment Method"
            ],
            [
                'name' => "coupon_code",
                'title' => "Coupon Code"
            ],
            [
                'name' => "coupon_code",
                'title' => "Coupon Code"
            ],
            [
                'name' => "slider",
                'title' => "Slider"
            ],
            [
                'name' => "point_policy",
                'title' => "Point Policy"
            ],
            [
                'name' => "breaking_news",
                'title' => "Breaking News"
            ],
            [
                'name' => "language",
                'title' => "language"
            ],
            [
                'name' => "transactionhead",
                'title' => "TransactionHead"
            ],
            [
                'name' => "stockadjustment",
                'title' => "Stock Adjustments"
            ],
            [
                'name' => "contact",
                'title' => "Contact"
            ],
            [
                'name' => "customerpayment",
                'title' => "Customer Payment"
            ],
            [
                'name' => "supplierpayment",
                'title' => "SupplierPayment"
            ],
            [
                'name' => "receipeprofile",
                'title' => "Receipe Profile"
            ],
            [
                'name' => "makeproduct",
                'title' => "Make Product"
            ],
            [
                'name' => "sales",
                'title' => "Sales"
            ],
            [
                'name' => "purchase",
                'title' => "Purchase"
            ],
            [
                'name' => "salesreports",
                'title' => "Sales Reports"
            ],
            [
                'name' => "purchasereports",
                'title' => "Purchase Reports"
            ],
            [
                'name' => "stockreports",
                'title' => "Stock Reports"
            ],
            [
                'name' => "orderports",
                'title' => "Order Reports"
            ],
            [
                'name' => "setting",
                'title' => "Setting"
            ],
            [
                'name' => "vendor",
                'title' => "Vendor"
            ],
        ];

        foreach ($permissionLists as $key => $value) {
            $permissionCategory = PermissionCategories::where('name', $value['name'])->first();
            if (!$permissionCategory) {
                $permissionCategory = new PermissionCategories;
                $permissionCategory->name = $value['name'];
                $permissionCategory->title = $value['title'];
                $permissionCategory->type = 'ba';
                $permissionCategory->status = 'Active';
                $permissionCategory->save();

                Permission::create(['name' => 'view ' . $value['name']]);
                Permission::create(['name' => 'view_all ' . $value['name']]);
                Permission::create(['name' => 'edit ' . $value['name']]);
                Permission::create(['name' => 'delete ' . $value['name']]);
            }
        }
    }
}
