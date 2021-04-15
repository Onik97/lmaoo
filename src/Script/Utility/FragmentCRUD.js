export default class FragmentUrl
{
    constructor(){
    this.urlFragment = 'unknown';
    }

    static createFragment()
    {
        let currentHTML = location.hash;
        console.log(currentHTML);
    }
}