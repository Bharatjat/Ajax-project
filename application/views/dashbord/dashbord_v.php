<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>employe dashbord</title>
</head>

<body>
    <!-- corusel - model for add employ -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myInputForm" action="" method="post" class="form-horizontal">
                        <div class="container p-2">
                            <input class="form-control" type="text" placeholder="Name" name="NewName">
                        </div>
                        <div class="container p-2">
                            <input class="form-control" type="text" placeholder="Address" name="NewAddress">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="AddEmp" data-dismiss="modal">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End corusel - model -->

    <!-- corusel - model for edit employ -->
    <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="false">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="myEditForm" action="" method="post" class="form-horizontal">
                        <div class="container p-2">
                            <input class="form-control" type="text" name="EditId" id="EditId" value="" style="display: none;">
                        </div>
                        <div class="container p-2">
                            <input class="form-control" type="text" placeholder="Name" name="EditName">
                        </div>
                        <div class="container p-2">
                            <input class="form-control" type="text" placeholder="Address" name="EditAddress">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="SaveEdit" data-dismiss="modal">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End corusel - model -->
    <div class="container p-5">
        <h4>
            Employe database add and search system using Ajax, Jquery, codeigniter, DBMS & Json.
        </h4>
    </div>
    <div class="" id="popup">

    </div>
    <div class="container pl-5 form-inline row form-inline">
        <div class="offset-3">
            <!-- Corusel - Button -->
            <button type="button" id="ShowModelAdd" class="btn btn-success text-white" data-toggle="modal" data-target="#exampleModalCenter">
                Add emplayee
            </button>
            <!-- End Corusal - Button -->
        </div>
        <div class="form-inline my-2 my-lg-0 offset-1">
            <form action="" method="post" id="searchform">
                <input class="form-control mr-sm-2" type="search" placeholder="Search (Id & Name)" aria-label="Search" id="SearchValue" name="SearchValue">
            </form>
            <button class="btn btn-info text-white" id="SearchBtn">
                Search
            </button>
        </div>
        <div class="offset-1">
            <button class="btn btn-info text-white" id="showall">
                Show all showAllEmployee
            </button>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <td>Id</td>
                    <td>Name</td>
                    <td>Address</td>
                    <td>created on</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody id="showdata">

            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(function() {

            $('#AddEmp').click(function() {
                var data = $('#myInputForm').serialize();
                $('#myInputForm').attr('action', '<?php echo base_url() ?>index.php/Dashbord/AddEmp');
                AddData(data);
            });

            $('#SearchBtn').click(function() {
                var search = $('#SearchValue').val();
                if (search.length > 0) {
                    Search();
                } else {
                    alert('search bar is Empty!');
                }
            });

            $('#showall').click(function() {
                showAllEmployee();
            });
        });

        function AddData(data) {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url('index.php/dashbord/AddEmp'); ?>',
                data: data,
                async: false,
                dataType: 'json',
                success: function(response) {
                    if (response == true) {
                        $('#popup').attr('class', ' container alert alert-success');
                        $('#popup').text('Employee added succesfully');
                        $('#popup').hide(3000);
                        showAllEmployee();
                    }
                },
                error: function() {
                    $('#popup').attr('class', ' container alert alert-danger');
                    $('#popup').text('Sorry something went wrong!');
                    $('#popup').hide(3000);
                }
            });
        }

        function Search() {
            var data = $('#searchform').serialize();
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url('index.php/dashbord/search'); ?>',
                data: data,
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#showdata').html('');
                    for (i = 0; i < response.length; i++) {
                        var html = '';
                        html += '<tr>' +
                            '<td>' + response[i].id + '</td>' +
                            '<td>' + response[i].name + '</td>' +
                            '<td>' + response[i].address + '</td>' +
                            '<td>' + response[i].created_on + '</td>' +
                            '<td>' +
                            '<a href="javascript:;" id="editbtn" class="btn btn-info item-edit"  data-toggle="modal" data-target="#editModalCenter" data="' + response[i].id + '">Edit</a>' +
                            '<a href="javascript:;" class="btn btn-danger item-delete" data="' + response[i].id + '">Delete</a>' +
                            '</td>' +
                            '</tr>';
                        var previoushtml = document.getElementById('showdata').innerHTML;
                        $('#showdata').html(previoushtml + html);
                    }
                },
                error: function(error) {
                    $('#popup').attr('class', ' container alert alert-danger');
                    $('#popup').text('Sorry search not found!');
                    $('#popup').hide(3000);
                }
            });
        }

        function showAllEmployee() {
            $.ajax({
                type: 'ajax',
                method: 'POST',
                url: '<?php echo base_url() ?>Dashbord/showAllEmployee',
                async: false,
                dataType: 'json',
                success: function(response) {
                    $('#showdata').html('');
                    var html = '';
                    var i;
                    for (i = 0; i < response.length; i++) {

                        html += '<tr>' +
                            '<td>' + response[i].id + '</td>' +
                            '<td>' + response[i].name + '</td>' +
                            '<td>' + response[i].address + '</td>' +
                            '<td>' + response[i].created_on + '</td>' +
                            '<td>' +
                            '<a href="javascript:;" class="btn btn-info item-edit" data-toggle="modal" data-target="#editModalCenter" data="' + response[i].id + '">Edit</a>' +
                            '<a href="javascript:;" class="btn btn-danger item-delete" data="' + response[i].id + '">Delete</a>' +
                            '</td>' +
                            '</tr>';
                    }
                    $('#showdata').html(html);
                },
                error: function() {
                    alert('Could not get Data from Database');
                }
            });
        }

        // Edit
        $('#showdata').on('click', '.item-edit', function() {
            var id = $(this).attr('data');
            $('#EditId').val(id);
            $('#myEditForm').attr('action', '<?php echo base_url() ?>index.php/Dashbord/editEmployee');
            $('#SaveEdit').on('click', function() {
                var data = $('#myEditForm').serialize();
                console.log(data);
                $.ajax({
                    type: 'ajax',
                    method: 'POST',
                    url: '<?php echo base_url('index.php/Dashbord/editEmployee') ?>',
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(data) {
                        showAllEmployee();
                        $('#popup').attr('class', ' container alert alert-success');
                        $('#popup').text('Employee edited');
                        $('#popup').hide(3000);
                    },
                    error: function() {
                        $('#popup').attr('class', ' container alert alert-danger');
                        $('#popup').text('Sorry something went wrong!');
                        $('#popup').hide(3000);
                    }
                });
            })
        });

        //delete- 
        $('#showdata').on('click', '.item-delete', function() {
            var id = $(this).attr('data');
            $.ajax({
                type: 'ajax',
                method: 'POST',
                async: false,
                url: '<?php echo base_url() ?>index.php/Dashbord/deleteEmployee',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    showAllEmployee();
                    $('#popup').attr('class', ' container alert alert-success');
                    $('#popup').text('Employee Deleted');
                    $('#popup').hide(3000);
                },
                error: function() {
                    $('#popup').attr('class', ' container alert alert-danger');
                    $('#popup').text('Sorry something went wrong!');
                    $('#popup').hide(3000);
                }
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>