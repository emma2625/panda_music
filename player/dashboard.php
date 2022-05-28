<?php 
  require_once "../assets/config/db_connect.php";
  require_once "../assets/includes/sessions.php";
  // Included Navbar
  $currentUser = $_SESSION['id'];
  $sql = "SELECT * FROM users WHERE id = '$currentUser'";
  $query = mysqli_query($connectDb,$sql);

 $row = mysqli_fetch_assoc($query);
  auth();
  include_once '../assets/includes/dashboard_nav.php';
?>
<div class="content-wrapper">
    <?php echo errorMessage(); echo successMessage();?>


    <div class="row">
        <div class="col-md-8 mb-2">
            <div class="card mx-auto p-3">
                <h5 class="card-title">Lastest Songs</h5>

                <div class="row">
                    <?php 
            $sql = "SELECT * FROM music";
            $query = mysqli_query($connectDb,$sql);
            while ($row = mysqli_fetch_assoc($query)) {
          ?>
                    <div class="col-md-4 mb-2">
                        <div class="card border position-relative" style="height: 350px;">
                            <img src="../assets/img/cover_img/<?php echo $row['cover_image']; ?>" height="170px"
                                class="card-img-top">
                            <div class="card-body">
                                <h5 class="fw-bold p-3 shadow-sm">Title: <span><?php echo $row['music_title']; ?></span>
                                </h5>
                                <h5 class="fw-bold p-3 shadow-sm">Artist:
                                    <span><?php echo $row['music_artist']; ?></span></h5>
                            </div>
                            <form id="playerList">
                                <input type="hidden" name="title" value="<?php echo $row['music_title']; ?>">
                                <input type="hidden" name="artist" value="<?php echo $row['music_artist']; ?>">
                                <input type="hidden" name="genre" value="<?php echo $row['genre']; ?>">
                                <input type="hidden" name="album" value="<?php echo $row['album']; ?>">
                                <input type="hidden" name="cover" value="<?php echo $row['cover_image']; ?>">
                                <input type="hidden" name="song" value="<?php echo $row['audio_file']; ?>">
                                <button class="btn position-absolute text-light px-3 btn-primary rounded-circle"
                                    style="right: 0; top: 10px;">
                                    <i class="fas fa-play-circle" style="font-size: 30px !important;"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                    <?php } ?>
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
                <img src="../assets/img/cover_img/pandaCoin.png" alt="" style="width: 200px; height:200px;"
                    class="card-img-top rounded-circle border d-block mx-auto">
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
<?php  include_once '../assets/includes/dashboard_footer.php'; ?>