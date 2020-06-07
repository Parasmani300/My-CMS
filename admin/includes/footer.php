
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <script>
        $(document).ready(function(){
     //This function select all check boxes when clicked
    $('#selectAllBoxes').click(function(event){
    if(this.checked) {
        $('.checkBoxes').each(function(){
            this.checked = true;
        });
    }else{
        $('.checkBoxes').each(function(){
            this.checked = false;
        });

    }

    });

    });
    </script>

    <script src="js/script.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>