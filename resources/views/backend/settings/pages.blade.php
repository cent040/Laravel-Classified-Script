@extends('backend.layouts.app')

@section('content')

 <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{url('/')}}">@lang('common.home')</a>
                        </li>
                     
                        <li class="active">
                            <strong>@lang('Pages Meta')</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

             <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>@lang('Pages Meta')	</h5>
                       
                    </div>
                    

<div class="ibox-content">
           
            <div class="table-responsive">
            <table class="table table-striped">
            <thead>
                <tr>

                    <th>@lang('common.title')</th>
                    <th>@lang('Keywords')</th>
                    <th>@lang('common.options')</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($pages)) { foreach ($pages as $row) { ?>
                    <tr id="{{$row->id}}">

                         <td>{{$row->title}}</td>
                         <td>{{$row->keywords}}</td>
                         <td> 
                            <a data-id="{{$row->id}}" class="edit" href="javascript:void(0)" data-toggle="modal" data-target="#myModal"> <i class="fa fa-edit"> </i> </a>
                           
                        </td>
                    </tr>
                <?php } 
                } else {  ?>
                <tr>
                    <td rowspan="5">@lang('common.no_record_found') </td> 
                </tr>
<?php } ?>

            </tbody>
        </table>
		
    </div>
    <!-- /.table-responsive -->
</div>
</div>
</div>
</div>
</div>

<?php

function clean($string) 
{
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}
?>




<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Add New</h4>
            </div>
            <form role="form" action="<?php echo route("save-meta"); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    {!! csrf_field() !!} 

                    <div class="form-group">
                        <label> Name </label>
                        <input class="form-control" required type="text" id="title" name="title">
                        <input class="form-control" type="hidden" id="id" name="id">
                    </div>
                    
					
					<div class="form-group">
                        <label> Meta Keywords </label>
                        <textarea class="form-control" id="keywords" name="keywords"></textarea>
                    </div>
					<div class="form-group">
                        <label> Description </label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    
					
                  


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $("body").on("click", ".add_new", function () {
        $("#name").val("");
        $("#description").val("");
        $("#keywords").val("");
        $("#id").val("");
    });
    $("body").on("click", ".edit", function () {
        var id = $(this).attr("data-id");
        var form_data = {
            id: id
        };
        $.ajax({
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '<?php echo route("get-meta"); ?>',
            data: form_data,
            success: function (msg) {
                var obj = $.parseJSON(msg);
                $("#title").val(obj['title']);
                $("#keywords").val(obj['keywords']);
                $("#description").val(obj['description']);
                $("#id").val(obj['id']);
            }
        });

    });


   

</script>



@endsection
