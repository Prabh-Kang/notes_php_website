<!-- original table -->


<table class="table table-striped my-4" id="myTable">
        <thead>
            <tr>
                <th scope="col">S. No.</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $serial = 1; ?>
            <?php foreach ($notes as $note) { ?>
                <tr>
                    <th scope="row"><?php echo $serial; ?></th>
                    <td><?php echo $note['notes_title']; ?></td>
                    <td><?php echo $note['notes_description']; ?></td>
                    <td><button class="btn btn-primary btn-sm">Edit</button> <button class="btn btn-primary btn-sm">Delete</button></td>
                </tr>
            <?php $serial = $serial + 1;
            }; ?>
        </tbody>
    </table>