<footer>
    <div class="footer-container">
        <div class="foot-img"><img src="./img/logoJ_v2.svg" alt="logo J"></div>
        <div class="footer-list">
            <ul>
                <li>Contact</li>
                <li>A propos</li>
                <li>Règlement</li>
                <?php 
                    if(isset($_SESSION['admin'])){
                        if ($_SESSION['admin'] === 'JulieS') {
                        echo "<li><a href='php_script/disconnect.php'>Déconnexion</a></li>";
                    }
                } else {
                    echo "<li><a href='connect.php'>Admin</a></li>";
                }
                        
                        

                    
                ?>


            </ul>
        </div>
    </div>
</footer>

<script src="js/script.js"></script>
</body>

</html>