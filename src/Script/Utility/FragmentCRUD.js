export default class FragmentUrl
{
    constructor(){
    this.urlFragment = 'unknown';
    }

    static createFragment()
    {
        let i = location.hash;
        console.log(i);
        return this.urlFragment = i;
    }

    static readFragment()
    {
        alert(this.urlFragment);
    }

    static updateFragment()
    {
        let b = location.hash
        console.log(b)
        return this.urlFragment = b;
    }

    static deleteFragment()
    {
        return this.urlFragment = 'unknown'
    }
}