<?php

/* @var $this yii\web\View */

?>
<div class="site-index">

    <h1 class="h1-title h1-title-index"><strong>School Diary System</strong></h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered detail-view admins-index-table">
            <tbody>
                <tr>
                    <th>Кількість користувачів</th>
                    <td><?= $data['users_count'] ?></td>
                </tr>
                <tr>
                    <th>Кількість шкіл</th>
                    <td><?= $data['schools_count'] ?></td>
                </tr>
                <tr>
                    <th>Кількість директорів</th>
                    <td>[<?= $data['directors_count'] ?> / <?= $data['users_count'] ?>]</td>
                </tr>
                <tr>
                    <th>Кількість учителів</th>
                    <td>[<?= $data['teachers_count'] ?> / <?= $data['users_count'] ?>]</td>
                </tr>
                <tr>
                    <th>Кількість учнів</th>
                    <td>[<?= $data['students_count'] ?> / <?= $data['users_count'] ?>]</td>
                </tr>
                <tr>
                    <th>Кількість батьків</th>
                    <td>[<?= $data['parents_count'] ?> / <?= $data['users_count'] ?>]</td>
                </tr>
                <tr>
                    <th>Кількість класів</th>
                    <td><?= $data['classes_count'] ?></td>
                </tr>
                <tr>
                    <th></th>
                    <td></td>
                </tr>
                <tr>
                    <th>Кількість проплат за журнал</th>
                    <td><?= $data['payments_count'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
        <?php if ($sums) : ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered detail-view admins-index-table admins-sum-table">
                    <thead>
                        <tr>
                            <th>Валюта</th>
                            <th>Сума з урахуванням комісій</th>
                            <th>Сума без комісій</th>
                            <th>Сума комісій</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($sums as $key => $value) : ?>
                            <tr>
                                <th><?= $key ?></th>
                                <td><?= $symbols[$key] . (number_format($value['amount_with_receiver_commission'], 2, ',', ' ')) ?? '0'; ?></td>
                                <td><?= $symbols[$key] . (number_format($value['amount_without_receiver_commission'], 2, ',', ' ')) ?? '0'; ?></td>
                                <td><?= $symbols[$key] . (number_format($value['receiver_commission'], 2, ',', ' ')) ?? '0'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    
    
</div>
