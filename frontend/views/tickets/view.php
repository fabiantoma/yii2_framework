<?php

/* @var $this yii\web\View */
/* @var $ticket Tickets */
use yii\helpers\Html;
use frontend\models\Tickets;
use frontend\models\User;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use yii\grid\ActionColumn;



?>


<html>



<body>

    <h3>Comment Handler Application</h3>

                <table border="2px" cellpadding="10" cellspacing="100" width="1000" height="200">
                
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Is_open</th>
                            <th>Date</th>
                            <th>Picture</th>
                            <th>Closing</th>
                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <td><?php echo $ticket->id; ?></td>
                                <td><?php echo $ticket->title; ?></td>
                                <td><?php echo $ticket->description; ?></td>
                                <td><?php echo $ticket->is_open; ?></td>
                                <td><?php echo $ticket->date; ?></td>
                                <td><?php echo $ticket->picture; ?></td>
                                <td><?= Html::submitButton('Close', ['class' => 'btn btn-primary']) ?></td>
                            </tr>
                    </tbody>
                </table>
    


        <table border="2px" cellpadding="10" cellspacing="100" width="800" height="100">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Opinion</th>
                            <th>Date</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($comments as $commen){
                        ?>
                            <tr>
                          
                                <td><?php echo $commen->id; ?></td>
                                <td><?php echo $commen->title; ?></td>
                                <td><?php echo $commen->opinion; ?></td>
                                <td><?php echo $ticket->date; ?></td>
                                <td><?php echo Html::img(''); ?></td>
                            </tr>
                      <?php      
                    }
                    ?>
                    </tbody>
        </table>




        <?php

        $form = ActiveForm::begin(['method'=>'post']) ?>
        <?= $form->field($comment, 'title') ?>
        <?= $form->field($comment, 'opinion') ?>
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <?php ActiveForm::end()?>



</html>
