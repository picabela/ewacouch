<?php if (!defined('EW_SITE')) { http_response_code(404); exit; } ?>
                                <div class="banner-podstrona">

                                        <div class="desc2">
<p class="tytul">kontakt</p>



                                    <p class="tresc-kontakt">
                                      <?= e($contact['name']) ?><br/>
                                      Tel:  <?= e($contact['phone']) ?><br/>
Email:  <a href="mailto:<?= e($contact['email']) ?>"><?= e($contact['email']) ?></a><br/>
<?= e($contact['street']) ?><br/>
<?= e($contact['postcode']) ?> <?= e($contact['city']) ?><br/>

                                      </p>

                                            <p class="tresc-kontakt2"> <span class="duza-niebieska">
                                         Napisz lub zadzwoń i umów się na spotkanie.</span>
                                         </p>


                                      <div class="zapr">


                                                                            <p class="duza-prawa2">Zapraszam!
</p>


                                        </div>


                                      </div>

                                </div>
