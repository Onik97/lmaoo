export default class Navbar{
     static homeActiveTab(){
        document.getElementById("homeNav").classList.add("active");
    }

    static projectActiveTab(){
        document.getElementById("projectNav").classList.add("active");
    }

    static accountActiveTab(){
        document.getElementById("accountNav").classList.add("active");
    }
}