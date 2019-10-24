using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
using UnityEngine.Networking;

public class MainMenuLogin : MonoBehaviour
{
    public InputField UsernameInput;
    public InputField PasswordInput;
    public Button SubmitButton;
    //string uri = "http://localhost/marker_creator/login.php";
    string uri = "http://0d09e399.ngrok.io/marker_creator/login.php";

    public GameObject LoginPanel;
    public GameObject CreatePanel;

    public void CallLogin()
    {
        StartCoroutine(Login());
    }

    IEnumerator Login()
    {
        WWWForm form = new WWWForm();
        form.AddField("username", UsernameInput.text);
        form.AddField("password", PasswordInput.text);
        UnityWebRequest www = UnityWebRequest.Post(uri, form);

        yield return www.SendWebRequest();
        if (www.downloadHandler.text[0] == '0')
        {
            DBManager.username = UsernameInput.text;
            LoginPanel.SetActive(false);
            CreatePanel.SetActive(true);

        }

        if (www.isNetworkError)
        {
            Debug.Log("Error While Sending: " + www.error);
        }
        else
        {
            Debug.Log("Recieved: " + www.downloadHandler.text);
        }
    }

    public void VerifyInput()
    {
        SubmitButton.interactable = (UsernameInput.text.Length >= 8 && UsernameInput.text.Length < 20 && PasswordInput.text.Length >= 8 && PasswordInput.text.Length < 20);
    }
}