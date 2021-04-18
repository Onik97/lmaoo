export default class Fragment
{
    static createFragment(currentLocationHash)
    {
        window.location.hash = `#${currentLocationHash}`;
    }

    static readFragment(currentLocationHash)
    {
        if (window.location.hash == '') { return('No Url Fragment loaded')}
        return(`#${currentLocationHash}`);
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