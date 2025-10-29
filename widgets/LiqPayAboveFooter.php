<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\{Url, Html};

class LiqPayAboveFooter extends Widget // Widget for users which don't have telegram id in system;
{

    public function init()
    {
        parent::init();

        echo '
        	<div class="above-footer">
	            <div class="container">
	                <div class="left-above-footer">
	                    <div class="luf-imgs">
	                        <img src="/images/visa-icon.png" title="Visa" alt="Visa" class="visa-img payment-nav-img">
	                        <img src="/images/mastercard-icon.png" alt="MasterCard" title="MasterCard" class="mastercard-img payment-nav-img">
	                    </div>
	                    <div>
	                        <p>До оплати приймаються міжнародні платіжні карти систем Visa та MasterCard будь-якого банку.</p>
	                    </div>
	                </div>
	                <div class="right-above-footer hidden-xs">
	                    <div>
	                        ' . Html::a('Політика конфіденційності', Url::to(['/app/privacy-policy'])) . '
	                        ' . Html::a('Публічна оферта', Url::to(['/app/public-offer'])) . '
	                    </div>
	                    <div>' . Html::a('Політика повернення коштів', Url::to(['/app/refund-policy'])) . '</div>
	                </div>
	                <div class="right-above-footer visible-xs">
	                    <div>' . Html::a('Політика конфіденційності', Url::to(['/app/privacy-policy'])) . '</div>
	                    <div>' . Html::a('Публічна оферта', Url::to(['/app/public-offer'])) . '</div>
	                    <div>' . Html::a('Політика повернення коштів', Url::to(['/app/refund-policy'])) . '</div>
	                </div>
	            </div>
	        </div>
	        <div class="about-school-diary-footer">
        		<div class="container">
        			<p><strong>School Diary</strong> - система електронної школи, створена українськими розробниками для надання Користувачам інформацію щодо їхньої успішності. Інформація надається у вигляді електронного журналу, де зберігається поточна успішність учня/студента, яка виставляється виключно силами вчителів або викладачів. Система передається у повне управління дирекції школи та викладацького складу з цілодобовою технічною онлайн-підтримкою. <strong>School Diary</strong> не продає свій продукт, а надає послуги у сфері освіти у довгострокове використання.</p>
        		</div>
        	</div>
	        ';

    }
    
    public function run()
    {
        return parent::run();
    }

}
