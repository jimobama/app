<?php
$model = ContextManager::$Model;
$list = new ArrayIterator();
$planeTem = new Plane();
if ($model == null || !is_a($model, "PlaneModelView")) {
    include_once "modelviews/PlaneModelView.php";
    include_once "models/PlaneModel.php";
    $model = new PlaneModelView();
}

if ($model->planeModel == null) {
    $model->planeModel = new PlaneModel();
}
$list = $model->planeModel->GetAllPlanes();
if ($model->plane != null) {
    $planeTem = $model->plane;
}
?>

<div class='container'>
    <?php
    $attr = new ArrayIterator();
    $attr->offsetSet("method", "post");
    ContextManager::BeginForm("Plane", "Modify", $attr);
    ?>

    <div class='title'>Planes Information: </div>
    <?  ContextManager::ValidationFor("warning-l"); ?>
    <table width="100%" class='table table-responsive borderless'>
        <tr>
            <th>S/N</th>
            <th>Name</th>
            <th>Total Seats</th>
            <th>Description</th>                                      
            <th>#</th>
        </tr>
        <?php
        for ($i = 0; $i < $list->count(); $i++) {
            $list->seek($i);
            $plane = new Plane();
            $plane = $list->current();
            $sn = $i + 1;
            $checked = "";
            if ($planeTem->Id == $plane->Id) {
                if ($planeTem->mode == 'edit') {
                    $checked = "checked='checked'";
                }
            }
            echo "<tr>
                        <td>$sn</td>
                        <td>$plane->name</td>
                        <td>$plane->seats</td>
                        <td>$plane->desc</td>                                         
                        <td><input type='checkbox' value='$plane->Id' name='chkplanes[]'  $checked ></td>
                    </tr>
                    ";
        }
        ?>

    </table>
    <div id="">
        <input type="submit" class='btn btn-primary' value="Edit/Modify" name="btnEdit"/>
        <input type="submit" class='btn btn-primary' value="Delete" name="btnDelete"/>
    </div>

    <?php ContextManager::EndForm() ?>
</div>



