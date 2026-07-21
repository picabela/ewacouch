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
                                        <strong> Écrivez-moi ou appelez-moi pour prendre rendez-vous.<bR>
                                        Premier entretien gratuit!</strong></span>
                                         </p>

                                      <div id="form_box">
                                        <form id="myForm" action="<?= e($assetBase) ?>ajax_email/send.php" method="post" name="myForm">
                                          <div>
                                            <p><label for="cf-name">Nom et prénom :</label></p>
                                            <input class="input" type="text" id="cf-name" name="name" required>
                                          </div>
                                          <div>
                                            <p><label for="cf-email">Adresse e-mail :</label></p>
                                            <input class="input" type="email" id="cf-email" name="e_mail" required>
                                          </div>
                                          <div>
                                            <p><label for="cf-phone">Téléphone (facultatif) :</label></p>
                                            <input class="input" type="tel" id="cf-phone" name="phone">
                                          </div>
                                          <div>
                                            <p><label for="cf-message">Message :</label></p>
                                            <textarea class="textarea" id="cf-message" name="message" rows="6" required></textarea>
                                          </div>
                                          <div class="hp-field" aria-hidden="true">
                                            <label for="cf-website">Ne pas remplir ce champ :</label>
                                            <input type="text" id="cf-website" name="website" tabindex="-1" autocomplete="off">
                                          </div>
                                          <div>
                                            <input class="submit" type="submit" value="Envoyer le message">
                                          </div>
                                        </form>
                                        <div id="log"><div id="log_res"></div></div>
                                      </div>

                                         </div>


                                        </div>

                                </div>
