<div id="navbar-example" class="navbar navbar-static">
    <div class="navbar-inner">
        <div class="container" style="width: auto;">
            <a data-toggle="modal" style="font-size: 16px" class="brand pull-left" id="add_project" href="#new_project"
               data-target="#new_project" data-id="">New project</a>
            <?=anchor('project/search', 'Search Project', 'class="brand" style="font-size: 16px"')?>
            <div class="nav pull-right">
                <p class="navbar-text pull-right">
                    <?php if ($this->session->userdata('logged_in')): ?>
                    Logged in as <?= $this->session->userdata('email') ?>
                    | <?= anchor('users/logout', 'Logout', 'class="navbar-text"') ?>
                    <?php endif;?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row-fluid">
    <div class="span10 offset2">
        <form class="form-horizontal">
            <div class="control-group">
                <label class="control-label" for="project_list">Change Project</label>

                <div class="controls">
                    <select class="span6" id="project_list" name="project_list">
                        <option value="">Select</option>
                        <?php foreach ($project_list as $value): ?>
                        <option value="<?=$value->id?>"><?=$value->business_name?> <?= $value->terminate==1? "(terminated)":""?> </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        </form>

    </div>
</div>

<div id="project_details" style="display: none">

    <div class="row-fluid" style="margin-top: 10px">
        <ul class="inline" id="selected_project">

        </ul>
    </div>

<h4 class="page-header">Project Details</h4>

<div class="row-fluid" >
    <div class="span3">
        <div class="row-fluid">
            <div class="span10 tabbable tabs-left">
                <ul class="nav nav-tabs" id="nav-tabs">
                    <li class="active">
                        <a data-toggle="tab" href="#company_information">Company Information </a>
                    </li>
                    <li><a data-toggle="tab" href="#2A">Cpanel</a></li>
                    <li><a data-toggle="tab" href="#3A">Services</a></li>
                    <li><a data-toggle="tab" href="#4A">Business Information</a></li>
                    <li><a data-toggle="tab" href="#5A">Keywords</a></li>
                    <li><a data-toggle="tab" href="#6A">Social Media</a></li>
                    <li><a data-toggle="tab" href="#7A">Google Services</a></li>
                    <li><a data-toggle="tab" href="#additional">Additional Data</a></li>
                    <li><a data-toggle="tab" href="#9A">Design Template</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="span9 tab-content">

        <?php echo $this->load->view('project/company_info')?>
        <?php echo $this->load->view('project/cpanel_info')?>
        <?php echo $this->load->view('project/services')?>
        <?php echo $this->load->view('project/business_info')?>
        <?php echo $this->load->view('project/keywords')?>
        <?php echo $this->load->view('project/social_media')?>
        <?php echo $this->load->view('project/google_service')?>
        <?php echo $this->load->view('project/additional')?>
        <?php echo $this->load->view('project/template_info')?>



    </div>

</div>
<!--row-fluid-->
</div>

<div class="modal hide fade" id="new_project">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Create New Project</h3>
    </div>
    <div class="modal-body">
        <span id="modal-msg"></span>

        <form class="form-horizontal" action="" name="project" method="post" id="project">

            <div class="control-group">
                <label class="control-label" for="business_name">Business Name</label>

                <div class="controls">
                    <input type="text" id="business_name" name="business_name" required="required" placeholder="">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="customer_first_name">Customer First Name</label>

                <div class="controls">
                    <input type="text" id="customer_first_name" required="required" name="customer_first_name"
                           placeholder="">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="customer_last_name">Customer Last Name</label>

                <div class="controls">
                    <input type="text" id="customer_last_name" required="required" name="customer_last_name"
                           placeholder="">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="customer_email">Customer Email address</label>

                <div class="controls">
                    <input type="text" id="customer_email" name="customer_email" placeholder="">
                </div>
            </div>

            <div class="control-group">
                <label class="control-label" for="customer_phone">Customer Phone</label>

                <div class="controls">
                    <input type="text" id="customer_phone" name="customer_phone" placeholder="">
                </div>
            </div>
            <div class="modal-footer">
                <a href="#new_project" data-dismiss="modal" class="btn closeme">Close</a>
                <button type="submit" class="btn btn-primary" id="save_data" data-id="">Save</button>
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">
var base_url = "<?=base_url()?>index.php/"

function showMessage(str) {
    //$('#msg').html('<div class="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>'+str+'</div>');
    //$('#msg').sticky();
    $.sticky(str);
}

$(document).ready(function (e) {

    $("#add_project").click(function () {

        $("#save_data").attr("disabled", false);
        $("#modal-msg").html('');
        $('.modal-header h3').text('Add New Project');
        $('#project').find("input[type=text]").val("");
    });

    $('#project_edit').live('click', function () {

        var id = $(this).data('id');
        $("#save_data").attr("disabled", false);
        $("#modal-msg").html('');
        $('.modal-header h3').text('Update Project');

        $.post(
                base_url+'project/getProject/' + id,
                function (data) {
                    if (data) {
                        console.log(data);
                        $.each(data, function (index, value) {
                            //console.log(index + ': ' + value);
                            $('#new_project form input[name="' + index + '"]').val(value);
                            $('#new_project').modal('show');
                        });


                    }

                }, 'json'
        );


    });
    // create new project and load project list
    $("#save_data").click(function (e) {

        e.preventDefault();
        if ($('#project input[name="business_name"]').val() == '') {
            $("#modal-msg").html('<div class="alert" data-toggle="1">Business name field can\' be blank</div>');
            return false;
        }
        else
            $(this).attr("disabled", true);
        var title = $('.modal-header h3').text();
        var id = '';
        if(title = "Add New Project")
            id = '';
        else
            id = $("#save_data").data('id');
        //alert(title);

        var pdata = $('#project').serialize();

        $.post(
                base_url+'project/save_project/' + id,
                pdata,
                function (data) {
                    console.log(data);
                    if (data) {
                        if (data)
                            $.post(base_url+"project/generateProjectList", function (list) {
                                $('#project_list').html(list);
                                $('#new_project').modal('hide');
                                $('#project_details').fadeOut(500);
                            });
                        if (id)
                            showMessage('Project has been updated');
                        else
                            showMessage('New project has been created');

                    }
                }
        );
    });

    <?php if($project):?>
    $('#project_details').show(0);
    var id = "<?=$project->id?>";
    $('#project_list').val(id);
    $("#save_data").data('id', id);
    $.post(
            base_url+'project/getProject/' + id,
            function (data) {
                if (data) {
                    console.log(data);
                    $.each(data, function (index, value) {
                        $('#' + index).val(value);

                    });
                    $.getJSON(base_url+'project/getProjectKeywords/' + id, function (data) {
                        $tm = '';
                        $.each(data, function (key, val) {
                            $tm += '<li id="' +'keyword_'+ val.id + '">' + val.keyword + '<a href="#key_del" data-id="' + val.id + '" class="delete_keyword"><i class="icon-remove right"></i></a></li>';
                        });
                        $('#keyword-data').empty().html($tm);

                    });
                    $.getJSON(base_url+'project/getProjectServices/' + id, function (data) {
                        $tm = '';
                        $.each(data, function (key, val) {
                            $tm += '<li id="' +'service_'+ val.id + '">' + val.service_name + '<a href="#key_del" data-id="' + val.id + '" class="delete_service"><i class="icon-remove right"></i></a></li>';
                        });
                        $('#service-data').empty().html($tm);

                    });

                    $.getJSON(base_url+'project/getAdditional/'+ id, function (data) {
                        $tm = '';
                        $.each(data, function (key, val) {
                            $tm += '<tr id="addi_'+val.id+'">';
                            $tm += '<td>' + val.key + '</td>';
                            $tm += '<td>' + val.value + '</td>';
                            $tm += '<td style="text-align:center"><a href="#del" class="del_me" data-id="'+val.id+'">X</a></td>';
                            $tm += '</tr>';
                        });

                        $('#additional_data tbody').empty().html($tm);

                    });

                    $("#selected_project").empty().html("<li><b>" + data['business_name'] + "</b></li><li><div class='navbar'><ul class='inline'><li><a href='#' id='project_edit' data-id='" + data['id'] + "'>[ Edit ]</a></li><li><a href='#project_delete' id='project_delete' data-id='" + data['id'] + "'>[ Delete ]</a></li><li><a href='#project_terminate' id='project_terminate' data-id='" + data['id'] + "'>[ Terminate ]</a></li></ul></div></li>");
                }

            }, 'json'
    );


    <?php endif;?>

    // change project from list
    $("#project_list").on('change', function () {
        if($(this).val()=='')
            $('#project_details').hide(0);
        else
            $('#project_details').show(0);
        $(this).selec
        console.log($(this).val());
        var id = $(this).val();
        $("#save_data").data('id', id);
        $.post(
                base_url+'project/getProject/' + id,
                function (data) {
                    if (data) {
                        console.log(data);
                        $.each(data, function (index, value) {
                            $('#' + index).val(value);

                        });
                        $.getJSON(base_url+'project/getProjectKeywords/' + id, function (data) {
                            $tm = '';
                            $.each(data, function (key, val) {
                                $tm += '<li id="' +'keyword_'+ val.id + '">' + val.keyword + '<a href="#key_del" data-id="' + val.id + '" class="delete_keyword"><i class="icon-remove right"></i></a></li>';
                            });
                            $('#keyword-data').empty().html($tm);

                        });
                        $.getJSON(base_url+'project/getProjectServices/' + id, function (data) {
                            $tm = '';
                            $.each(data, function (key, val) {
                                $tm += '<li id="'+'service_' +val.id + '">' + val.service_name + '<a href="#key_del" data-id="' + val.id + '" class="delete_service"><i class="icon-remove right"></i></a></li>';
                            });
                            $('#service-data').empty().html($tm);

                        });

                        $.getJSON(base_url+'project/getAdditional/'+ id, function (data) {
                            $tm = '';
                            $.each(data, function (key, val) {
                                $tm += '<tr id="addi_'+val.id+'">';
                                $tm += '<td>' + val.key + '</td>';
                                $tm += '<td>' + val.value + '</td>';
                                $tm += '<td style="text-align:center"><a href="#del" class="del_me" data-id="'+val.id+'">X</a></td>';
                                $tm += '</tr>';
                            });

                            $('#additional_data tbody').empty().html($tm);

                        });
                        var ter = (data['terminate']==1) ? '':"<li><a href='#project_terminate' id='project_terminate' data-id='" + data['id'] + "'>[ Terminate ]</a></li>";
                        $("#selected_project").empty().html("<li><b>" + data['business_name'] + "</b></li><li><div class='navbar'><ul class='inline'><li><a href='#' id='project_edit' data-id='" + data['id'] + "'>[ Edit ]</a></li><li><a href='#project_delete' id='project_delete' data-id='" + data['id'] + "'>[ Delete ]</a></li>"+ter+"</ul></div></li>");
                    }

                }, 'json'
        );
    }).change(true);



    $("#project_delete").live('click', function (e) {
        var id = $(this).data('id');
        e.preventDefault();
        if (confirm('Do you really want to delete this project?') == true) {
            $.post(
                    base_url+'project/deleteProject/' + id,
                    function (data) {
                        if (data) {
                            $('#selected_project li').remove();
                            showMessage('Project deleted Successfully');
                            $(':input', '.tab-content form')
                                    .not(':button, :submit, :reset, :hidden')
                                    .val('')
                                    .removeAttr('checked')
                                    .removeAttr('selected');
                            $.post(base_url+"project/generateProjectList", function (list) {
                                $('#project_list').html(list);

                            });

                        }
                    }, 'json'
            );
        }
    });

    $("#project_terminate").live('click', function (e) {
        var id = $(this).data('id');
        e.preventDefault();
        if (confirm('Do you really want to Terminate this project?') == true) {
            $.post(
                    base_url+'project/terminateProject/' + id,
                    function (data) {
                        if (data) {
                            $('#selected_project li').remove();
                            showMessage('Project terminated Successfully');
                            $(':input', '.tab-content form')
                                    .not(':button, :submit, :reset, :hidden')
                                    .val('')
                                    .removeAttr('checked')
                                    .removeAttr('selected');
                            $.post(base_url+"project/generateProjectList", function (list) {
                                $('#project_list').html(list);

                            });

                        }
                    }, 'json'
            );
        }
    });


    $('button[name="save"]').on('click', function (e) {
        e.preventDefault();
        var id = $("#save_data").data('id');
        if (!id) {
            showMessage('Please select project from list');
            return false;
        }
        var pdata = $('#' + $(this).data('form')).serialize();

        $.post(
                base_url+'project/save_project/' + id,
                pdata,
                function (data) {
                    console.log(data);
                    if (data) {
                        showMessage('Data saved Successfully');
                    }
                }
        );
    });

    $('button[name="add"]').on('click', function (e) {
        e.preventDefault();
        var id = $("#save_data").data('id');
        if (!id) {
            showMessage('Please select project from list');
            return false;
        }
        var pdata = $('#' + $(this).data('form')).serialize();
        $.post(
                base_url+'project/saveProjectKeywords/' + id,
                pdata,
                function (data) {
                    console.log(data);
                    if (data) {
                        $('#keyword').val('');
                        $.getJSON(base_url+'project/getProjectKeywords/' + id, function (data) {
                            $tm = '';
                            $.each(data, function (key, val) {
                                $tm += '<li id="' +'keyword_'+ val.id + '">' + val.keyword + '<a href="#key_del" data-id="' + val.id + '" class="delete_keyword"><i class="icon-remove right"></i></a></li>';
                            });
                            $('#keyword-data').empty().html($tm);

                        });
                        showMessage('Data saved Successfully');
                    }
                }
        );
    });

    $('button[name="add_service"]').on('click', function (e) {
        e.preventDefault();
        var id = $("#save_data").data('id');
        if (!id) {
            showMessage('Please select project from list');
            return false;
        }
        var pdata = $('#' + $(this).data('form')).serialize();
        $.post(
                base_url+'project/saveProjectService/' + id,
                pdata,
                function (data) {
                    console.log(data);
                    if (data) {
                        $('#service_name').val('');
                        $.getJSON(base_url+'project/getProjectServices/' + id, function (data) {
                            $tm = '';
                            $.each(data, function (key, val) {
                                $tm += '<li id="' +'service_'+ val.id + '">' + val.service_name + '<a href="#key_del" data-id="' + val.id + '" class="delete_service"><i class="icon-remove right"></i></a></li>';
                            });
                            $('#service-data').empty().html($tm);

                        });
                        showMessage('Data saved Successfully');
                    }
                }
        );
    });
    $('button[name="add_additional"]').on('click', function (e) {
        e.preventDefault();
        var id = $("#save_data").data('id');
        var data_name = $(this).data('name');
        if (!id) {
            showMessage('Please select project from list');
            return false;
        }

        var pdata = $('#' + $(this).data('form')).serialize();
        $.post(
                base_url+'project/saveAdditional/'+ id,
                pdata,
                function (data) {
                    console.log(data);
                    if (data) {
                        $("#"+data_name+"_info input")
                                .not(':button, :submit, :reset, :hidden')
                                .val('')
                                .removeAttr('checked')
                                .removeAttr('selected');

                        $.getJSON(base_url+'project/getAdditional/'+ id, function (data) {
                            $tm = '';
                                $.each(data, function (key, val) {
                                    $tm += '<tr id="addi_'+val.id+'" >';
                                    $tm += '<td>' + val.key + '</td>';
                                    $tm += '<td>' + val.value + '</td>';
                                    $tm += '<td style="text-align:center"><a href="#del" class="del_me" data-id="'+val.id+'">X</a></td>';
                                    $tm += '</tr>';
                                });

                            $('#'+data_name+'_data tbody').empty().html($tm);

                        });
                        showMessage('Data saved Successfully');
                    }
                }
        );
    });


    $('.del_me').live('click',function(){
        var id = $(this).data('id');
        if(confirm('Do you really want to delete this item?')){
            $.post(
                    base_url+'project/deleteAdditional/'+ id,
                    function(data){
                        if(data){
                            $('#addi_'+id).remove();
                            showMessage('Additional data deleted Successfully');
                        }
                    }
            );
        }


    });

    $('.delete_service').live('click',function(){
        var service_id = $(this).data('id');
        console.log(service_id);
        if(confirm('Do you want to delete this service?')){
            $.post(
                    base_url+'project/deleteService/'+ service_id,
                    function(data){
                        if(data){
                            $("#service_"+service_id).remove();
                            showMessage('Service deleted Successfully');
                        }

                    }
            );
        }

    });

    $('.delete_keyword').live('click',function(){
        var keyword_id = $(this).data('id');
        if(confirm('Do you want to delete this Keyword?')){
            $.post(
                base_url+'project/deleteKeyword/'+ keyword_id,
                function(data){
                    if(data)
                    {
                        $("#keyword_"+keyword_id).remove();
                        showMessage('Keyword deleted Successfully');
                    }

                }
            );
        }
    });





});
</script>