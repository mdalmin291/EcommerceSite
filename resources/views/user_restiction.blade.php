@extends('layouts.backend_app')
@section('content')
<div>
    <x-slot name="title">
        User Permission
    </x-slot>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="search-box mr-2 mb-2 d-inline-block">
                                <div class="position-relative">
                                    <h4 class="card-title design_title">User Permission</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div  class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form id="permission_update_form" action="{{route('user-management.user_restictions.update')}}" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        @if($user)
                        <input type="hidden" name="id" value="{{$user->id}}">
                        @endif
                    <div  class="table-responsive">
                        <table id="salesTable" class="table table-striped table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="thead_design">

                            <tr>
                                <th>SL</th>
                                <th>Module Name</th>
                                <th>Permission</th>
                            </tr>

                            </thead>
                            <tbody>
                                @foreach($permissionCategorys as $permissionCategory)
                                <tr>
                                    <td>{{$permissionCategory->id}}</td>
                                    <td>{{$permissionCategory->title}}</td>
                                    <td>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox1" name="permission[]" value="view {{$permissionCategory->name}}" @if(in_array("view $permissionCategory->name", $permissions)) checked @endif > View &nbsp;&nbsp;
                                       </label>
                                        <label class="checkbox-inline">
                                            <input type="checkbox" id="inlineCheckbox1"  name="permission[]" value="edit {{$permissionCategory->name}}" @if(in_array("edit $permissionCategory->name", $permissions)) checked @endif  > Edit &nbsp;&nbsp;
                                        </label>
                                        <label class="checkbox-inline">
                                           <input type="checkbox" id="inlineCheckbox1" name="permission[]" value="delete {{$permissionCategory->name}}" @if(in_array("delete $permissionCategory->name", $permissions)) checked @endif  > Delete &nbsp;&nbsp;
                                        </label>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <center>
                        <button type="submit" class="btn btn-success " >
                            Update
                        </button>
                    </center>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function(){
		$('#permission_update_form').ajaxForm({
			beforeSend: formBeforeSend,
			beforeSubmit: formBeforeSubmit,
			error: formError,
			success: function (responseText, statusText, xhr, $form) {
				formSuccess(responseText, statusText, xhr, $form);
                alert('Test')
			},
			clearForm: false,
			resetForm: false
		});
	});
</script>
@endsection
