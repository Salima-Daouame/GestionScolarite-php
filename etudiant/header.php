<nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                                    <div class="noti__item js-item-menu">
                                        <i class="zmdi zmdi-notifications"></i>
                                        <span class="quantity"><?php echo $notifCount[0] ?></span>
                                        <div class="notifi-dropdown js-dropdown">
                                            <div class="notifi__title">
                                                <p>You have <?php echo $notifCount[0] ?> Notifications</p>
                                            </div>
                                            <?php
                                            while($res = $notifications->fetch()){
                                              $notification = $student->getNotification($res['Id_notification']);
                                              echo '
                                              <div class="notifi__item">
                                                  <div class="bg-c1 img-cir img-40">
                                                      <i class="zmdi zmdi-email-open"></i>
                                                  </div>
                                                  <div class="content">
                                                    <a href="notification.php?id='.$res['Id_notification'].'">
                                                      <p>'.substr($notification['Notification'], 0, 50).'...</p>
                                                      <span class="date">'.$notification['Date_notification'].'</span>
                                                    </a>
                                                  </div>
                                              </div>';
                                            }
                                            ?>
                                            <div class="notifi__footer">
                                                <a href="notifications.php">All notifications</a>
                                            </div>
                                        </div>
                                    </div>
              </li>
         <li class="nav-item active">
                    <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">Profil</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="deconnexion.php"><i class="fa fa-sign-out"></i></i></a>
                </li>
                </li>
                
              </ul>
            </div>
          </div>
        </nav>