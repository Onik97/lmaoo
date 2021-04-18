export default class Fragment
{
    static createFragment(currentLocationHash)
    {
        window.location.hash = `#${currentLocationHash}`;
    }

    static readFragment()
    {
        if (window.location.hash == '') { return('No Url Fragment loaded')}
        console.log(window.location.hash);
        return(window.location.hash);
    }

    static updateFragment(currentLocationHash)
    {
        window.location.hash = `#${currentLocationHash}`;
    }

    static deleteFragment()
    {
        window.location.hash = ''
    }
}