export default class FragmentUrl
{
    constructor(){
    this.urlFragment = 'unknown';
    }

    static createFragment(currentLocationHash)
    {
        window.location.hash = currentLocationHash;
        return this.urlFragment = currentLocationHash;
    }

    static readFragment()
    {
        alert(this.urlFragment);
    }

    static updateFragment(currentLocationHash)
    {
        window.location.hash = currentLocationHash
        return this.urlFragment = currentLocationHash;
    }

    static deleteFragment()
    {
        window.location.hash = ''
        return this.urlFragment = 'No url hash location'
    }
}