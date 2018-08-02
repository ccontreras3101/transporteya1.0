<?php 
    use yii\helpers\Html;
?>

<?php echo Html::beginForm(); ?>
    <div id="language-select">
        <?php 
		if(sizeof($languages) > 4) {
                    $lastElement = end($languages);
                    foreach($languages as $key=>$lang) {
                        if($key != $currentLang) {
                            echo Html::a($lang,'',
                                [ 
                                    'name'=>'_lang',
                                    'id'=>"_lang",
                                    'type'=>'post',
                                    'data'=>'_lang='.$key.'&YII_CSRF_TOKEN='.Yii::$app->request->csrfToken,
                                    'success' => 'function(data) {window.location.reload()};'
                                ]
                            );
                        } 
                        else
                        {
                            echo '<b>'.$lang.'</b>';
                        }
                        if($lang != $lastElement)
                        {
                            echo ' | ';
                        }
                    }
                }
		else
		{
                    echo Html::dropDownList('_lang', $currentLang, $languages,
                        array(
                            'csrf'=>true,
                            'class'=>'drpd',
                            
                        )
                    ); 
		}
        ?>
        
   <?php
    $this->registerJs('     
        $(document).on("change", ".drpd", function(){
            _lang = $(this).val();
            $.ajax({
                    method: "POST",
                    url : "index.php?r=site/language",
                    aSync: false,
                    dataType:"html",
                    data:{
                        language:_lang,
                     },
                    success: function(data){
                    location.reload();
                 } 
                });
        });
            ')
?>
        
    </div>
<?php echo Html::endForm(); ?>