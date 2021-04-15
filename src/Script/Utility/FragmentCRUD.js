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
    }
}