<div id="additional" class="tab-pane">
    <form class="form-horizontal" name="additional_info" id="additional_info">
        <div class="control-group">
            <label class="control-label" for="additional_name">Name</label>
            <div class="controls">
                <select id="additional_name" name="key">
                    <option value="Name 1">Name 1</option>
                    <option value="Name 2">Name 2</option>
                    <option value="Name 3">Name 3</option>

                </select>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="additional_value">Data</label>

            <div class="controls">
                <textarea name="value" id="additional_value" cols="10" rows="8"></textarea>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="btn btn-primary" data-form="additional_info" data-name="additional" name="add_additional">Add</button>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">&nbsp</label>
            <div class="controls">
                <table class="table table-bordered table-striped" style="width: 80%" id="additional_data">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Data</th>
                        <th style="text-align:center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>