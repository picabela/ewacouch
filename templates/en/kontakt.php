<?php if (!defined('EW_SITE')) { http_response_code(404); exit; } ?>
                                <div class="banner-podstrona">

                                        <div class="desc2">
<p class="tytul">Contact</p>



                                      <div class="prawa-tresc2">
                                       <p class="tresc-kontakt">
                                      <?= e($contact['name']) ?><br/>
                                      Tel:  <?= e($contact['phone']) ?><br/>
Email:  <a href="mailto:<?= e($contact['email']) ?>"><?= e($contact['email']) ?></a>

                                      </p>
                                         <p class="tresc-kontakt2"> <span class="duza-niebieska">
                                        <strong> Please feel free to send me an email or call me in order to make  an appointment or ask any questions.</strong></span>
                                         </p>

                                         </div>


                                        </div>

                                </div>
