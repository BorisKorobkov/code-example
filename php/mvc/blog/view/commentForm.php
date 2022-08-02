<?php
/**
 * Detail page. Add comment
 *
 * @var Controller $this
 */

use mvc\Controller;

?>
<div class="well">
    <form class="form-horizontal">
        <div class="form-group">
            <label for="commentName" class="col-sm-2">Name *</label>
            <div class="col-sm-10"><input type="text" class="form-control" id="commentName" placeholder="Name"></div>
        </div>
        <div class="form-group">
            <label for="commentEmail" class="col-sm-2">Mail (optional)</label>
            <div class="col-sm-10"><input type="email" class="form-control" id="commentEmail" placeholder="Email"></div>
        </div>
        <div class="form-group">
            <label for="commentUrl" class="col-sm-2">URL (optional)</label>
            <div class="col-sm-10"><input type="text" class="form-control" id="commentUrl" placeholder="URL"></div>
        </div>
        <div class="form-group">
            <label for="commentRemark" class="col-sm-2">Remark</label>
            <div class="col-sm-10"><textarea class="form-control" id="commentRemark" placeholder="Remark"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-default disabled">Send</button>
        (does not work)
    </form>
</div>