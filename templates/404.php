<?php if (!defined('EW_SITE')) { http_response_code(404); exit; }
list($nfTitle, $nfText, $nfLink) = $langCfg['not_found'];
?>
                                <div class="banner-podstrona">

                                        <div class="desc2">
<p class="tytul">404</p>
                                      <p class="tresc"><strong><?= e($nfTitle) ?></strong><br><br>
<?= e($nfText) ?><br><br>
<a href="<?= e(page_url($lang, 'index')) ?>"><?= e($nfLink) ?> &#8658;</a>
</p>
<div class="przerwa"></div>

                                        </div>

                                </div>
