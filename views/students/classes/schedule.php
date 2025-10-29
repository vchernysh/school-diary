<?php
use yii\helpers\{Html, Url};

/* @var $this yii\web\View */
/* @var $model app\models\Classes */

$this->title = 'Розклад уроків класу: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Класи', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="class-lessons-view">

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>
    <?php if ($show_message) : ?>
        <code>Якщо у розкладі є поле з <span class="several-lessons-background" style="color:#000; display: inline-block; padding: 0 5px;">жовтим кольором</span> - це означає, що уроки або чергуються через тиждень, або йдуть паралельно.</code>
        <br>
        <br>
        <br>
    <?php endif; ?>

    <div class="class-lessons-wrap">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">Понеділок</th>
                    </tr>
                    <?php if ($lessons['Monday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Monday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">Вівторок</th>
                    </tr>
                    <?php if ($lessons['Tuesday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Tuesday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">Середа</th>
                    </tr>
                    <?php if ($lessons['Wednesday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Wednesday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-sm-6 visible-sm">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">Четвер</th>
                    </tr>
                    <?php if ($lessons['Thursday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Thursday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 hidden-sm col-xs-12">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">Четвер</th>
                    </tr>
                    <?php if ($lessons['Thursday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Thursday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">П'ятниця</th>
                    </tr>
                    <?php if ($lessons['Friday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Friday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-sm-6 visible-sm">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">Субота</th>
                    </tr>
                    <?php if ($lessons['Saturday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Saturday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 hidden-sm col-xs-12">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">Субота</th>
                    </tr>
                    <?php if ($lessons['Saturday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Saturday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th colspan="2">Неділя</th>
                    </tr>
                   <?php if ($lessons['Sunday']) { ?>
                        <tr>
                            <th>№</th>
                            <th>Предмет</th>
                        </tr>
                        <?php foreach($lessons['Sunday'] as $key => $value) :
                            echo '<tr>';
                                $several_lessons_background = '';
                                if (count($value) > 1) {
                                    $several_lessons_background = ' class="several-lessons-background"';
                                }
                                echo '<td>' . $key . '</td>';
                                echo '<td' . $several_lessons_background . '>' . implode(' / ', $value) . '</td>';
                            echo '</tr>';
                        endforeach; 
                    } else { ?>
                        <tr>
                            <td colspan="2">-</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>