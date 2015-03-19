<div class="row">
<?php

function writeOrg ($id, $orgName, $logoUrl, $description) {
  echo '<a href="./single_org.php?org=' . $id . '">';
  echo '<div id="listbox">';
  echo ' <div id="logobox"><img src="' . $logoUrl . '">';
  echo ' </div> ';
  echo ' <div id="textbox"> ';
  echo '<p>' . $orgName . '</p></div></div></a>';
}

include 'database_init.php';

$con = getDBConnection($db_config);
$query = "SELECT orgs.id, name, orgs.logo_url, headline FROM orgs LEFT JOIN logo_details ON (orgs.id = logo_details.id) WHERE org_status = 1 and logo_details.valid = 1 ORDER BY name";
$results = $con->query($query);

$i=0;
while ($row = $results->fetch_assoc()) {
  $id = $row["id"];
  $orgName = $row["name"];
  $logoUrl = $row["logo_url"];
  $logoUrl = './localimage.php?org=' . $id . '&width=200&height=100';
  $headline = $row["headline"];
  writeOrg($id, $orgName, $logoUrl, $headline);
  $i++;
  if ($i % 4 == 0 ) {
    echo '</div>';
    echo '<div class="row">';
  }
}
?>
</div>
