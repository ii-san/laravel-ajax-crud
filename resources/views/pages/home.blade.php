@extends('layouts.base')
@section('content')
<div class="row p-5">
    <h1>Student Page</h1>
    <div class="col-lg">
        <div class="p-2">
            <a href="javascript:void(0)" class="btn btn-sm btn-success" id="addStudent">+ Add Student</a>
        </div>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    <div class="modal fade" id="ajaxModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <form id="studentForm" name="studentForm" class="form-control">
                        @csrf
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="form-group mb-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email Adress" value="" required>
                        </div>
                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $(".data-table").DataTable({
            serverSide: true,
            processing: true,
            ajax: "{{ route('students.index')}}",
            columns: [
                {data:'DT_RowIndex', name:'DT_RowIndex'},
                {data:'name', name:'name'},
                {data:'email', name:'email'},
                {data:'action', name:'action'},
                ]
        });
            
        $("#addStudent").click(function(){
            $('#student_id').val("");
            $('#studentForm').trigger('reset');
            $('#modalHeading').html('Add Student');
            $('#ajaxModal').modal('show');
        });
        
        $("#btn-save").click(function(e){
            e.preventDefault();
            $(this).html('Save');

            $.ajax({
                data: $('#studentForm').serialize(),
                url: "{{ route('students.store')}}",
                type: 'POST',
                datatype: 'json',
                success: function(data){
                    $('#studentForm').trigger('reset');
                    $('#ajaxModal').modal('hide');
                    table.draw();
                },
                error:function(data){
                    console.log('Error: ',data);
                    $('#btn-save').html('Save');
                }
                }); 
            });
            $('body').on('click','.deleteStudent', function(){
                
                var student_id = $(this).data("id");
                confirm("Are you sure want to delete?");
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('students.store')}}"+'/'+student_id,
                    success: function(data){
                        table.draw();
                    },
                    error: function(data){
                        console.log('Error: ', data);
                    }
                });
            });

            $('body').on('click', '.editStudent', function(){
                var student_id = $(this).data('id');
                $.get('{{ route('students.index')}}'+'/'+student_id+'/edit', function(data){
                    $('modalHeading').html('Edit Student');
                    $('#ajaxModal').modal('show');
                    $('#student_id').val(data.id);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                });
            });
        });
        
    </script>
    </div>
</div>
@endsection