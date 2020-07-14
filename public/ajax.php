<script>
    //Getting value from "ajax.php".


    var ok = document.getElementById("search").value;

    fill(ok);

    function fill(Value) {
        console.log("oooo");

        //Assigning value to "search" div in "search.php" file.
        $('#search').val(Value);
        //Hiding "display" div in "search.php" file.
        $('#display').hide();
    }
    $(document).ready(function() {
        console.log("oooo");

        //On pressing a key on "Search box" in "search.php" file. This function will be called.
        $("#search").keyup(function() {
            //Assigning search box value to javascript variable named as "name".
            var name = $('#search').val();
            //Validating, if "name" is empty.
            if (name == "") {
                //Assigning empty value to "display" div in "search.php" file.
                $("#display").html("");
            }
            //If name is not empty.
            else {
                console.log("oooo");

                //AJAX is called.
                $.ajax({
                    console.log("oooo")

                    //AJAX type is "Post".
                    type: "POST",
                    //Data will be sent to "ajax.php".
                    url: "outro.php",
                    //Data, that will be sent to "ajax.php".
                    data: {
                        //Assigning value of "name" into "search" variable.
                        search: name
                    },
                    //If result found, this funtion will be called.
                    success: function(html) {
                        //Assigning result to "display" div in "search.php" file.
                        $("#display").html(html).show();
                        console.log("oooo")
                    }
                });
            }
        });
    });
</script>