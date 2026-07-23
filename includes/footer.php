<?php
/**
 * Wspólna stopka strony - zamyka układ otwarty w header.php.
 */

if (!defined('EW_SITE')) {
    http_response_code(404);
    exit;
}
?>
                            </div>
                        </div>

                    </main> <!-- .content-main -->
                </div> <!-- .main-page -->
            </div> <!-- .row -->
            <footer class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 footer">
<?php if (!empty($page['social_footer'])): ?>
                  <p class="fb">znajdź mnie na: <br>
                 <a href="<?= e($contact['facebook']) ?>" target="_blank" rel="noopener" aria-label="Facebook - Ewa Wędrychowska"> <img src="<?= e($assetBase) ?>images/fb.png" alt="Facebook" width="36" height="36" loading="lazy" decoding="async"></a>&nbsp;  <a href="<?= e($contact['linkedin']) ?>" target="_blank" rel="noopener" aria-label="LinkedIn - Ewa Wędrychowska"><img src="<?= e($assetBase) ?>images/linkedin.png" alt="LinkedIn" width="36" height="36" loading="lazy" decoding="async"></p>
<?php endif; ?>
                </div>
            </footer>  <!-- .row -->
<?php if (!empty($langCfg['copyright'])): ?>
            <div class="row"><p style="text-align:center;margin-top: 10px;color: #999;font-size: 12px;">Copyrights <?= date('Y') ?> Ewa Wędrychowska Coach | <?= e($contact['street']) ?>, <?= e($contact['postcode']) ?> <?= e($contact['city']) ?></p></div> <!-- .row -->
<?php endif; ?>
        </div> <!-- .container -->
    </div> <!-- .main-body -->

</body>
</html>
