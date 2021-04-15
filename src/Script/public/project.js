import Navbar from "../public/navbar.js";
import FragmentUrl from "../Utility/FragmentCRUD.js";

$(document).ready(() => { Navbar.projectActiveTab(); });

$('#fragmentCreate').click(function(){ FragmentUrl.createFragment() });

$('#fragmentRead').click(function(){ FragmentUrl.readFragment() });

$('#fragmentUpdate').click(function(){ FragmentUrl.updateFragment() });

$('#fragmentDelete').click(function(){ FragmentUrl.deleteFragment() });