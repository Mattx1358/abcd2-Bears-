<?php
session_start();
require 'bin/functions.php';
require 'db_configuration.php';

// Define the number of sponsors per row
define('NUMBER_OF_SPONSORS_PER_ROW', 2); // Change this number to 2, 3, or 4 as needed

// Separate queries for organizations and individuals
$query_org = "SELECT * FROM sponsors WHERE type='organization'";
$data_org = mysqli_query($db, $query_org);

$query_ind = "SELECT * FROM sponsors WHERE type='individual'";
$data_ind = mysqli_query($db, $query_ind);

$page_title = 'Project ABCD > Sponsors';
include('header.php');

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    echo '<link rel="stylesheet" href="css/viewers_style.css">';
}
?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
    <!-- Admin View with Table Layout -->
    <div class="container-fluid">
        <h2 id="title">Sponsor Management</h2><br>
        
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <button><a class="btn btn-sm" href="create_sponsor.php">Create New Sponsor</a></button>
        <?php endif; ?>
        
        <table class="display" id="sponsorsTable" style="width:100%">
            <div class="table responsive">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Logo</th>
                    <th>Description</th>
                    <th>Website URL</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if ($data->num_rows > 0) {
                    while ($row = $data->fetch_assoc()) {
                        echo '<tr>
                                <td>' . $row["sponsor_id"] . '</td>
                                <td>' . $row["name"] . '</td>
                                <td>' . $row["type"] . '</td>
                                <td><img src="' . $row["logo"] . '" class="thumbnailSize"></td>
                                <td>' . $row["description"] . '</td>
                                <td><a href="' . $row["website_url"] . '" target="_blank">' . $row["website_url"] . '</a></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="display_the_sponsor.php?id=' . $row["sponsor_id"] . '">View</a>
                                    <a class="btn btn-warning btn-sm" href="modify_sponsor.php?id=' . $row["sponsor_id"] . '">Edit</a>
                                    <a class="btn btn-danger btn-sm" href="deleteSponsor.php?id=' . $row["sponsor_id"] . '">Delete</a>
                                </td>
                            </tr>';
                    }
                } else {
                    echo "<tr><td colspan='7'>No sponsors found</td></tr>";
                }
                ?>
                </tbody>
            </div>
        </table>
    </div>

<?php else: ?>

    <!-- Viewer View -->
    <div class="container-fluid">
        <!-- Our Supporters and SPONSORS & PARTNERS -->
        <div class="ribbon">
             <div>Our Supporters</div>
             <div>SPONSORS & PARTNERS</div>
         </div>
        <!-- Organizations Grid -->
        <div class="ribbon"><div>Organizations</div></div>
        <div class="sponsors-logo-top grid-container-<?php echo NUMBER_OF_SPONSORS_PER_ROW; ?>">
            <?php
            if ($data_org->num_rows > 0) {
                while ($row = $data_org->fetch_assoc()) {
                    echo '<div class="grid-item">
                            <a href="display_the_sponsor.php?id=' . $row["sponsor_id"] . '" title="' . $row["name"] . '">
                                <img src="' . $row["logo"] . '" alt="' . $row["name"] . '" class="grid-image">
                                <div class="grid-title">' . $row["name"] . '</div>
                            </a>
                          </div>';
                }
            } else {
                echo "<div class='grid-no-data'>No Organizations Found</div>";
            }
            ?>
        </div>

        <!-- Individuals Grid -->
        <div class="ribbon"><div>Individuals</div></div>
        <div class="sponsors-logo-top grid-container-<?php echo NUMBER_OF_SPONSORS_PER_ROW; ?>">
            <?php
            if ($data_ind->num_rows > 0) {
                while ($row = $data_ind->fetch_assoc()) {
                    echo '<div class="grid-item">
                            <a href="display_the_sponsor.php?id=' . $row["sponsor_id"] . '" title="' . $row["name"] . '">
                                <img src="' . $row["logo"] . '" alt="' . $row["name"] . '" class="grid-image">
                                <div class="grid-title">' . $row["name"] . '</div>
                            </a>
                          </div>';
                }
            } else {
                echo "<div class='grid-no-data'>No Individuals Found</div>";
            }
            ?>
        </div>
    </div>
<?php endif; ?>

   
<!-- Footer -->
<footer class="page-footer text-center">
    <p>Created for FA23 ICS 499 ♡</p>
</footer>

<!-- Scripts -->
<!--JQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#sponsorsTable').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#sponsorsTable thead tr').clone(true).appendTo( '#sponsorsTable thead' );
        $('#sponsorsTable thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#sponsorsTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>
</body>
</html>