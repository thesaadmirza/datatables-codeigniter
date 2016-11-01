<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>

<div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
            <li class="active"><a class="btn btn-primary" href="<?= base_url() ?>news/create">Add news/post</a></li>
            <li><a class="btn btn-success" href="<?= base_url() ?>news">News list</a></li>
        </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Dashboard</h1>


            <!-- Notification boxes -->
            <?php if($this->session->flashdata('success_msg')){ ?>
                <p class="alert alert-info">
                    <?php echo $this->session->flashdata('success_msg'); ?>
                </p>
            <?php } ?>
                <div class="row form-inline">
                    <div class="col-md-3" >
                        <span class="control-label">type</span>
                        <select class="form-control" id="dropdown1">
                            <option value="">all</option>
                            <option value="1">download</option>
                            <option value="2">request</option>
                        </select>
                    </div>
                </div>
                <hr>
                    <!-- Example table -->
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>IP</th>
                            <th>Customer Type</th>
                            <th>operations</th>
                        </tr>

                        </thead>
                        <tbody>
                        </tbody>

                    </table>

        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        var table =   $('#example2').DataTable({
            scrollY: '', /*'65vh'*/
            scrollCollapse: true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin_mailinglist/ajax_list')?>",
                "type": "POST"
            },

            columns: [
                {},
                {},
                {},
                {},
                {},
                /* EDIT */ {
                    mRender: function (data, type, row) {
                        if (row[5] == 1) {
                            return '<td>download<td>';
                        }else{
                            return '<td>request<td>';
                        }
                    }
                },
                /* EDIT */
                {
                    mRender: function (data, type, row) {
                        return '<a class="btn btn-sm btn-danger delete"  href="<?= base_url() ?>admin_mailinglist/ajax_delete/'+row[6]+'" title="delete"   >DELETE</a>'

                    }
                }

            ],
            "stripeClasses": ['', '']
        });


        $('#dropdown1').on('change', function () {
            if (!!this.value) {
                table.column(5).search(this.value).draw();
            } else {
                table.column(5).search(this.value).draw();
            }
        } );




    } );


</script>