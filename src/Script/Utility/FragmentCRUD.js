export default class FragmentUrl
{
    static createFragment(currentLocationHash)
    {
        window.location.hash = currentLocationHash;
    }

    static readFragment(currentLocationHash)
    {
        if (window.location.hash == '') { alert('No Url Fragment loaded')}
        alert(currentLocationHash);
    }

    static updateFragment(currentLocationHash)
    {
        window.location.hash = currentLocationHash
    }

    static deleteFragment()
    {
        window.location.hash = ''
    }
}