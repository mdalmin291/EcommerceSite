@push('css')
       
        <!-- Sweet Alert -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/datatables/datatables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}">
@endpush
<div>
    <x-slot name="title">
        Stock Adjustment Reports
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title">Stock Adjustment Reports</h4>
                                </div>
                            </div>
                        </div>
                    </div><hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                              <div class="col-md-2">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">From Date</label>
                                    <input id= "daterange" type="date" class="form-control" wire:model.lazy="to_date"/>
                                </div>
                              </div>

                              <div class="col-md-2">
                                <div class="form-group">
                                    <label for="basicpill-firstname-input">To Date</label>
                                    <input id= "daterange" type="date" class="form-control" wire:model.lazy="to_date"/>
                                </div>
                              </div>

                              <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="basicpill-lastname-input">Branch</label>
                                                    <select class="form-control" wire:model.lazy="branch_id">
                                                        <option value="">Select Branch</option>
                                                       @foreach ($branches as $branch)
                                                         <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                        @endforeach
                                                    </select>
                                    @error('branch_id') <span class="error">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-lg-3">
                            <div class="form-group">
                                <label for="basicpill-firstname-input">Select Customer</label>
                                <select class="form-control" placeholder="Customer" wire:model.lazy="contact_id">
                                    <option>Select Customer</option>
                                    @foreach ($contacts as $contact)
                                    <option value="{{ $contact->id }}">{{ $contact->name }}</option>
                                    @endforeach
                                </select>
                                @error('contact_id') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                            
                            </div>
                           
                        </div>

                           
                       
                    </div>

                    
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div wire:ignore class="table-responsive">
                        <table id="datatable-buttons" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Contact Id</th>
                                <th>From Branch Id</th>
                                <th>To Branch Id</th>
                                <th>From Warehouse Id</th>
                                <th>To Warehouse Id</th>
                                <th>Note</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php
                             $i=0;
                            @endphp
                                @foreach($this->dateFilter($stocks) as $stock)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $stock->date }}</td>
                                    <td>{{ $stock->type }}</td>
                                    <td>{{ $stock->contact_id }}</td>
                                    <td>{{ $stock->from_branch_id }}</td>
                                    <td>{{ $stock->to_branch_id }}</td>
                                    <td>{{ $stock->from_warehouse_id }}</td>
                                    <td>{{ $stock->to_warehouse_id }}</td>
                                    <td>{{ $stock->note }}</td>
                                    
                                </tr>
                                @endforeach
                            </tbody>
                               
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')

<script>
              $( "#daterange" ).change(function() {
                // $this->date=$( ".date" ).val();
                @this.set(date, $( "#daterange" ).val());
               });

            $(function() {
            $('input[name="daterange"]').daterangepicker({
                opens: 'left'
            }, function(start, end, label) {
                console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
            });
        </script>
        <!-- Plugins js -->
        <script src="{{ URL::asset('assets/libs/datatables/datatables.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/jszip/jszip.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

        <!-- Init js-->
        <script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>

        <!-- Sweet Alerts js -->
        <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <!-- Sweet alert init js -->
        <script src="{{ URL::asset('assets/js/pages/sweet-alerts.init.js')}}"></script>
       
@endpush

