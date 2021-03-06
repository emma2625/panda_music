<?php
require_once "../assets/config/db_connect.php";
require_once "../assets/includes/sessions.php";
// Included Navbar
$currentUser = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$currentUser'";
$query = mysqli_query($connectDb, $sql);

$row = mysqli_fetch_assoc($query);
auth();
include_once '../assets/includes/dashboard_nav.php';
?>
<div class="content-wrapper">
    <?php echo errorMessage();
    echo successMessage(); ?>

    <?php if ($_SESSION['role'] !== 'admin') { ?>
        <div class="row">
            <div class="col-md-8 mb-2">
                <div class="card mx-auto p-3">
                    <h5 class="card-title">Lastest Songs</h5>

                    <div class="row">
                        <?php
                        if (!isset($_GET['search'])) {
                            $sql = "SELECT * FROM music";
                        }
                        else{
                            $searchedFor = $_GET['search'];
                            $sql = "SELECT * FROM music WHERE music_title LIKE '%$searchedFor%' OR  music_artist LIKE '%$searchedFor%' OR genre LIKE '%$searchedFor%' OR  album LIKE '%$searchedFor%'";
                        }
                        $query = mysqli_query($connectDb, $sql);
                        if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <div class="col-md-4 mb-2">
                                <div class="card border position-relative" style="height: 350px;">
                                    <img src="../assets/img/cover_img/<?php echo $row['cover_image']; ?>" height="170px" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="fw-bold p-3 shadow-sm">Title: <span><?php echo $row['music_title']; ?></span>
                                        </h5>
                                        <h5 class="fw-bold p-3 shadow-sm">Artist:
                                            <span><?php echo $row['music_artist']; ?></span>
                                        </h5>
                                    </div>
                                    <form id="playerList">
                                        <input type="hidden" name="title" value="<?php echo $row['music_title']; ?>">
                                        <input type="hidden" name="artist" value="<?php echo $row['music_artist']; ?>">
                                        <input type="hidden" name="genre" value="<?php echo $row['genre']; ?>">
                                        <input type="hidden" name="album" value="<?php echo $row['album']; ?>">
                                        <input type="hidden" name="cover" value="<?php echo $row['cover_image']; ?>">
                                        <input type="hidden" name="song" value="<?php echo $row['audio_file']; ?>">
                                        <button class="btn position-absolute text-light px-3 btn-primary rounded-circle" style="right: 0; top: 10px;">
                                            <i class="fas fa-play-circle" style="font-size: 30px !important;"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                        <?php
                             }
                            }//end of if
                            else{
                            ?>
                            <h2 class="text-center text-info">Sorry, we could not find this song</h2>
                            <img src="../assets/img/sadface.gif" alt="" class="img-fluid d-block mx-auto my-2">
                            <?php }?>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3 position-relative">
                <div class="position-absolute d-none" id="btnLayer" style="top: 35%; left: 39%; z-index: 999;">
                    <button class="btn d-none" id="play">
                        <i class="fas fa-play-circle" style="font-size: 40px !important;"></i>
                    </button>
                    <button class="btn" id="pause">
                        <i class="fas fa-pause-circle" style="font-size: 40px !important;"></i>
                    </button>
                </div>
                <div class="card shadow p-3" id="ourMusicPlayer">
                    <img src="../assets/img/cover_img/pandaCoin.png" alt="" style="width: 200px; height:200px;" class="card-img-top rounded-circle border d-block mx-auto">
                    <div class="d-flex justify-content-center mt-5">

                    </div>
                    <audio src="../assets/music/" id="toPlay" type="audio/mp3"></audio>
                    <div class="mt-2" style="font-weight: bold !important;">
                        <ul class="list-unstyled">
                            <li>
                                <h5 class="fw-bold border p-3 shadow-sm">Artist: <span>John Doe</span></h5>
                            </li>
                            <li>
                                <h5 class="fw-bold border p-3 shadow-sm">Title: <span>John Doe</span></h5>
                            </li>
                            <li>
                                <h5 class="fw-bold border p-3 shadow-sm">Genre: <span>John Doe</span></h5>
                            </li>
                            <li>
                                <h5 class="fw-bold border p-3 shadow-sm">Album: <span>John Doe</span></h5>
                            </li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    <?php } else { ?>
        <!-- /////////////////////////////////////////////////////////////////////////////////////////////////// -->
        <div class="card shadow p-3">
            <div class="d-flex justify-content-end">
                <div class="card p-2 shadow-sm">
                    <h5>
                        <i class="fa fa-users"></i> Total Users
                    </h5>
                    <?php
                    $sql = "SELECT * FROM users WHERE user_role != 'admin'";
                    $query = mysqli_query($connectDb, $sql);
                    echo "<h6 class=\"text-center\">" . mysqli_num_rows($query) . "</h6>"
                    ?>
                </div>
            </div>

            <div class="table-responsive my-3">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Country</th>
                            <th scope="col">...</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!isset($_GET['search'])) {
                            $sql = "SELECT * FROM users WHERE user_role != 'admin'";
                        }else{
                            $searchedFor = $_GET['search'];

                            $sql = "SELECT * FROM users WHERE full_name LIKE '%$searchedFor%' OR country LIKE '%$searchedFor%' OR email LIKE '%$searchedFor%' OR acct_num LIKE '%$searchedFor%' OR username LIKE '%$searchedFor%' AND user_role != 'admin'";
                        }
                        $query = mysqli_query($connectDb, $sql);
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                            <tr>
                                <th scope="row"><?php echo $row['username']; ?></th>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['country']; ?></td>
                                <td>
                                    <a href="user-details?user=<?php echo $row['acct_num']; ?>" class="fa fa-eye btn btn-outline-info"></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        </div>
    <?php } ?>
</div>

<script>
    const player = document.querySelector('#ourMusicPlayer');
    const toPlay = document.querySelector('#toPlay');

    const playerList = document.querySelectorAll('#playerList');

    let play = document.querySelector('#play');
    let pause = document.querySelector('#pause');

    playerList.forEach((forms) => {
        forms.addEventListener('submit', (e) => {
            e.preventDefault();
            let music = {
                title: forms.title.value,
                artist: forms.artist.value,
                genre: forms.genre.value,
                album: forms.album.value,
                cover: forms.cover.value,
                song: forms.song.value
            }

            player.innerHTML = `
          <img src="../assets/img/cover_img/${music.cover}" alt="" style="width: 200px; height:200px;" class="card-img-top rounded-circle border d-block mx-auto">
          <div class="d-flex justify-content-center mt-5">
             
          </div>
          <audio src="../assets/music/${music.song}" id="toPlay" type="audio/mp3"></audio>
          <div class="mt-2" style="font-weight: bold !important;">
            <ul class="list-unstyled">
              <li>
                <h5 class="fw-bold border p-3 shadow-sm">Artist: <span>${music.artist}</span></h5> 
              </li>
              <li>
                <h5 class="fw-bold border p-3 shadow-sm">Title: <span>${music.title}</span></h5> 
              </li>
              <li>
                <h5 class="fw-bold border p-3 shadow-sm">Genre: <span>${music.genre}</span></h5> 
              </li>
              <li>
                <h5 class="fw-bold border p-3 shadow-sm">Album: <span>${music.album}</span></h5> 
              </li>
            </ul>
          </div>
        `;
            setTimeout(() => {
                const toPlay = document.querySelector('#toPlay');
                toPlay.play();
            }, 1000)
            const btnLayer = document.querySelector('#btnLayer');
            btnLayer.classList.remove('d-none');
        })
    })

    play.addEventListener('click', () => {
        let toPlay = document.querySelector('#toPlay');
        toPlay.play()
        pause.classList.toggle('d-none')
        play.classList.toggle('d-none')
    })
    pause.addEventListener('click', () => {
        let toPlay = document.querySelector('#toPlay');
        toPlay.pause()
        pause.classList.toggle('d-none')
        play.classList.toggle('d-none')
    })
</script>
<!-- Included footer -->
<?php include_once '../assets/includes/dashboard_footer.php'; ?>