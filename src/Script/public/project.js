import Navbar from "../public/navbar.js";
import FragmentUrl from "../Utility/FragmentCRUD.js";

$(document).ready(() => { Navbar.projectActiveTab(); });

$('fragmentCreate').on("click", "#fragmentCreate", function(){ alert('worked')})