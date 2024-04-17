<div class="row mt-5">
            <div class="col">
                <ul class="list-group">
                <?php
                    foreach($getUse as $user) {
                        ?>
                    <li class="list-group-item bg-transparent border-0"><?=$user['nom']?></li>

                <?php
                }
                ?>
                </ul>
            </div>