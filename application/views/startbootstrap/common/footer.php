
    <div class="container">
        <footer>
            <hr>
            <div class="row">
                <div class="col-lg-12">
                    <p>&copy; Project 2015</p>
                </div>
            </div>
        </footer>
    </div>
    <!-- /.container -->


    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    

<?
if (!empty($counters))
    echo $counters->text;
?>
    
    
</body>

</html>