using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class MainMenuNavigation: MonoBehaviour
{
    public GameObject PanelToClose;
    public GameObject PanelToOpen;

    public void PanelSwitch()
    {
        PanelToClose.SetActive(false);
        PanelToOpen.SetActive(true);
    }

}
