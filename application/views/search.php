<style type="text/css">

    div.dataTables_length label {
        float: left;
        text-align: left;
    }

    div.dataTables_length select {
        width: 75px;
    }

    div.dataTables_filter label {
        float: right;

    }

    div.dataTables_info {
        padding-top: 8px;
    }

    div.dataTables_paginate {
        float: right;
        margin: 0;
    }

    table {
        margin: 1em 0;
        clear: both;
    }

    table.dataTable th:active {
        outline: none;
    }

    table .header {
        cursor: pointer;
    }

    table .header:after {
        content: "";
        float: right;
        margin-top: 7px;
        border-width: 0 4px 4px;
        border-style: solid;
        border-color: #000 transparent;
        visibility: hidden;
    }

    table .headerSortUp, table .headerSortDown {
        background-color: rgba(141, 192, 219, 0.25);
        text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    }

    table .header:hover:after {
        visibility: visible;
    }

    table .headerSortDown:after, table .headerSortDown:hover:after {
        visibility: visible;
        filter: alpha(opacity = 60);
        -khtml-opacity: 0.6;
        -moz-opacity: 0.6;
        opacity: 0.6;
    }

    table .headerSortUp:after {
        border-bottom: none;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        border-top: 4px solid #000;
        visibility: visible;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        filter: alpha(opacity = 60);
        -khtml-opacity: 0.6;
        -moz-opacity: 0.6;
        opacity: 0.6;
    }

    table .blue {
        color: #049cdb;
        border-bottom-color: #049cdb;
    }

    table .headerSortUp.blue, table .headerSortDown.blue {
        background-color: #ade6fe;
    }

    table .green {
        color: #46a546;
        border-bottom-color: #46a546;
    }

    table .headerSortUp.green, table .headerSortDown.green {
        background-color: #cdeacd;
    }

    table .red {
        color: #9d261d;
        border-bottom-color: #9d261d;
    }

    table .headerSortUp.red, table .headerSortDown.red {
        background-color: #f4c8c5;
    }

    table .yellow {
        color: #ffc40d;
        border-bottom-color: #ffc40d;
    }

    table .headerSortUp.yellow, table .headerSortDown.yellow {
        background-color: #fff6d9;
    }

    table .orange {
        color: #f89406;
        border-bottom-color: #f89406;
    }

    table .headerSortUp.orange, table .headerSortDown.orange {
        background-color: #fee9cc;
    }

    table .purple {
        color: #7a43b6;
        border-bottom-color: #7a43b6;
    }

    table .headerSortUp.purple, table .headerSortDown.purple {
        background-color: #e2d5f0;
    }


</style>
<script src="<?=base_url()?>public/assets/js/jquery.dataTables.min.js"></script>
<div id="navbar-example" class="navbar navbar-static">
    <div class="navbar-inner">
        <div class="container" style="width: auto;">

            <?=anchor('project', '<< Back', 'class="brand" style="font-size: 16px"')?>
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

<h2 class="page-header">Search Project</h2>
<table class="table table-striped table-bordered" id="project_table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Business Name</th>
        <th>Customer First Name</th>
        <th>Customer Last Name</th>
        <th>Customer Email</th>
        <th>Customer Phone</th>
        <th>Company Domain</th>
        <th>Company Address</th>
        <th>Company City</th>
        <th>Company State</th>
        <th>Company ZipCode</th>
        <th>Load Project</th>

    </tr>
    </thead>
    <tbody>
    <?php if(is_array($projects) && count($projects)>0):?>
    <?php foreach ($projects as $project): ?>
    <tr>
        <td><?=$project->id?></td>
        <td><?=$project->business_name?></td>
        <td><?=$project->customer_first_name?></td>
        <td><?=$project->customer_last_name?></td>
        <td><?=$project->customer_email?></td>
        <td><?=$project->customer_phone?></td>
        <td><?=$project->company_domain?></td>
        <td><?=$project->company_address?></td>
        <td><?=$project->company_city?></td>
        <td><?=$project->company_state?></td>
        <td><?=$project->company_zipcode?></td>
        <td><?=anchor('project/index/'.$project->id,'load')?></td>
    </tr>
        <?php endforeach;?>
    <?php endif; ?>
    </tbody>
</table>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        /* Default class modification */
        $.extend($.fn.dataTableExt.oStdClasses, {
            "sSortAsc":"header headerSortDown",
            "sSortDesc":"header headerSortUp",
            "sSortable":"header"
        });

        /* API method to get paging information */
        $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
            return {
                "iStart":oSettings._iDisplayStart,
                "iEnd":oSettings.fnDisplayEnd(),
                "iLength":oSettings._iDisplayLength,
                "iTotal":oSettings.fnRecordsTotal(),
                "iFilteredTotal":oSettings.fnRecordsDisplay(),
                "iPage":Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages":Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        }

        /* Bootstrap style pagination control */
        $.extend($.fn.dataTableExt.oPagination, {
            "bootstrap":{
                "fnInit":function (oSettings, nPaging, fnDraw) {
                    var oLang = oSettings.oLanguage.oPaginate;
                    var fnClickHandler = function (e) {
                        e.preventDefault();
                        if (oSettings.oApi._fnPageChange(oSettings, e.data.action)) {
                            fnDraw(oSettings);
                        }
                    };

                    $(nPaging).addClass('pagination').append(
                            '<ul>' +
                                    '<li class="prev disabled"><a href="#">&larr; ' + oLang.sPrevious + '</a></li>' +
                                    '<li class="next disabled"><a href="#">' + oLang.sNext + ' &rarr; </a></li>' +
                                    '</ul>'
                    );
                    var els = $('a', nPaging);
                    $(els[0]).bind('click.DT', { action:"previous" }, fnClickHandler);
                    $(els[1]).bind('click.DT', { action:"next" }, fnClickHandler);
                },

                "fnUpdate":function (oSettings, fnDraw) {
                    var iListLength = 5;
                    var oPaging = oSettings.oInstance.fnPagingInfo();
                    var an = oSettings.aanFeatures.p;
                    var i, j, sClass, iStart, iEnd, iHalf = Math.floor(iListLength / 2);

                    if (oPaging.iTotalPages < iListLength) {
                        iStart = 1;
                        iEnd = oPaging.iTotalPages;
                    }
                    else if (oPaging.iPage <= iHalf) {
                        iStart = 1;
                        iEnd = iListLength;
                    } else if (oPaging.iPage >= (oPaging.iTotalPages - iHalf)) {
                        iStart = oPaging.iTotalPages - iListLength + 1;
                        iEnd = oPaging.iTotalPages;
                    } else {
                        iStart = oPaging.iPage - iHalf + 1;
                        iEnd = iStart + iListLength - 1;
                    }

                    for (i = 0, iLen = an.length; i < iLen; i++) {
                        // Remove the middle elements
                        $('li:gt(0)', an[i]).filter(':not(:last)').remove();

                        // Add the new list items and their event handlers
                        for (j = iStart; j <= iEnd; j++) {
                            sClass = (j == oPaging.iPage + 1) ? 'class="active"' : '';
                            $('<li ' + sClass + '><a href="#">' + j + '</a></li>')
                                    .insertBefore($('li:last', an[i])[0])
                                    .bind('click', function (e) {
                                        e.preventDefault();
                                        oSettings._iDisplayStart = (parseInt($('a', this).text(), 10) - 1) * oPaging.iLength;
                                        fnDraw(oSettings);
                                    });
                        }

                        // Add / remove disabled classes from the static elements
                        if (oPaging.iPage === 0) {
                            $('li:first', an[i]).addClass('disabled');
                        } else {
                            $('li:first', an[i]).removeClass('disabled');
                        }

                        if (oPaging.iPage === oPaging.iTotalPages - 1 || oPaging.iTotalPages === 0) {
                            $('li:last', an[i]).addClass('disabled');
                        } else {
                            $('li:last', an[i]).removeClass('disabled');
                        }
                    }
                }
            }
        });

        /* Table initialisation */

        $('#project_table').dataTable({
            "sDom":"<'row'<'span4'l><'span8'f>r>t<'row'<'span4'i><'span8'p>>",
            "sPaginationType":"bootstrap"

        });
    });
</script>