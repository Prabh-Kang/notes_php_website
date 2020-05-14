<?php include("./templates/header.php") ?>
<?php
// Setting up the connection with MySql
$servername = "localhost";
$username = "prabh";
$password = "prabh123";
$dbname = "notes_website";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    // echo "Connection successful";
}

// Saving the data to the database

if (isset($_POST['submit'])) {
    echo $_POST['noteTitle'];
    echo $_POST['noteBody'];
    $notes_title = mysqli_real_escape_string($conn, $_POST['noteTitle']);
    $notes_description = mysqli_real_escape_string($conn, $_POST['noteBody']);
    $sql = "INSERT INTO notes(notes_title, notes_description) VALUES ('$notes_title', '$notes_description')";
    if (mysqli_query($conn, $sql)) {
        // mysqli_query($conn, $sql);
        // echo "saved successfully";
    } else {
        echo mysqli_error($conn);
    }
}



// update the database on clicking save changes in the edit note modal
if (isset($_POST['saveChangesBtn'])){
    $editNoteTitle = mysqli_real_escape_string($conn, $_POST['editNoteTitle']);
    $editNoteBody = mysqli_real_escape_string($conn, $_POST['editNoteBody']);
    $editNoteId = mysqli_real_escape_string($conn, $_POST['note_id']);
    $sql = "UPDATE `notes` SET `notes_title` = '$editNoteTitle', `notes_description` = '$editNoteBody' WHERE `notes`.`id` = '$editNoteId';";
    if(mysqli_query($conn, $sql)) {
        // echo "changes made successfully";
    }
    else {
        // echo "changes unsuccessful";
    }
}

// Deleting the note from the database
if(isset($_POST['deleteBtn'])) {
    $deleteNoteId = mysqli_real_escape_string($conn, $_POST['delNoteId']);
    $sql = "DELETE FROM `notes` WHERE `notes`.`id` = '$deleteNoteId' ";
    if(mysqli_query($conn, $sql)) {
        // echo "deleted successfully";
    }
    else {
        // echo "delete unsuccessful";
    }
}




// Fetching the data from the database

// writing the query
$sql = 'SELECT notes_title, notes_description, id FROM notes';

// make query and get the result
$result = mysqli_query($conn, $sql);

// convert the result in the form of an array
$notes = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free up the space and connection - not required but good practice
mysqli_free_result($result);


// dont echo, will give error. use print_r instead
// print_r($notes);
mysqli_close($conn);

?>

<div class="container">
    <h1 class="my-3 text-center" id="headingh1">Welcome to Notes</h1>
    <form action="index.php" method="POST" class="my-4">
        <div class="form-group">
            <label for="noteTitle">Note title</label>
            <input type="text" class="form-control" id="noteTitle" name="noteTitle">
        </div>
        <div class="form-group">
            <label for="noteBody">Note description</label>
            <textarea class="form-control" id="noteBody" name="noteBody" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Add Note</button>
    </form>
    <hr>

    <table class="table my-4 table-borderless" id="mySecondTable">
        <thead class="my-2">
            <tr>
                <th scope="col"><span class="h1">Your Notes</span></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($notes as $note) { ?>
                <tr>
                    <th class="d-flex justify-content-center">

                        <div class="card text-center w-100">
                            <div class="card-body" style="background-color: #F8F8F8">
                                <p class="card-title h2 "><?php echo $note['notes_title']; ?></p>
                                
                                <p class="card-text"><?php echo $note['notes_description']; ?></p>
                                <p class="d-none"><?php echo $note['id'];?></p>
                                <button type="button" class="btn btn-primary editBtn" data-toggle="modal" data-target="#editModal">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-primary delBtn" data-toggle="modal" data-target="#deleteModal">
                                    Delete
                                </button>
                            </div>
                            <!-- <div class="card-footer text-muted">

                            </div> -->
                        </div>
                    </th>
                </tr>
            <?php  }; ?>
        </tbody>
    </table>

</div>



<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index.php" method="POST">
                    <div class="form-group">
                        <label for="editNoteTitle">Note title</label>
                        <input type="text" class="form-control" id="editNoteTitle" name="editNoteTitle">
                        <input type="hidden" name="note_id" id="note_id">
                    </div>
                    <div class="form-group">
                        <label for="editNoteBody">Note description</label>
                        <textarea class="form-control" id="editNoteBody" name="editNoteBody" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary saveChangesBtn" id="saveChangesBtn" name="saveChangesBtn">
                </form>
                
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- <div class="modal-header">
                <p class="modal-title h3" id="exampleModalCenterTitle">Delete Note</p>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div> -->
            <div class="modal-body m-3">
                <form action="index.php" method="POST">
                    <p class="h3">Are you sure ? </p>
                <div class="modal-footer mt-3">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-danger" id="deleteBtn" name="deleteBtn"> Yes </button>
                    <input type="hidden" name="delNoteId" id="delNoteId">
                </form>
                
            </div>
        </div>
    </div>
</div>
















<?php include("./templates/footer.php") ?>