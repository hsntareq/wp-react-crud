import React, { useState, useEffect } from "react";
import axios from "axios";

const Settings = () => {
  const [firstname, setFirstname] = useState("");
  const [lastname, setLastname] = useState("");
  const [email, setEmail] = useState("");
  const [loader, setLoader] = useState("Save Settings");

  const url = `${appLocalizer.apiUrl}wpr/v1/settings`;


  const handleSubmit = (e) => {
    e.preventDefault();
    setLoader("Saving...");
    axios
      .post(
        url,
        {
          firstname: firstname,
          lastname: lastname,
          email: email,
        },
        {
          headers: {
            "content-type": "application/json",
            "X-WP-NONCE": appLocalizer.nonce,
          },
        }
      )
      .then((res) => {
        setLoader("Save Settings");
      });
  };

  useEffect(() => {
    axios
      .get(url, {
        headers: {
          "content-type": "application/json",
          "X-WP-NONCE": appLocalizer.nonce,
        },
      })
      .then((res) => {
        setFirstname(res.data.firstname);
        setLastname(res.data.lastname);
        setEmail(res.data.email);
      });
  }, []);

  return (
    <React.Fragment>
      <h2>React Settings form</h2>
      <form id="wpr-settings" onSubmit={(e) => handleSubmit(e)}>
        <table className="form-table" role="presentation">
          <tbody>
            <tr>
              <th scope="row">
                <label htmlFor="firstname">Firstname</label>
              </th>
              <td>
                <input
                  id="firstname"
                  name="firstname"
                  className="regular-text"
                  value={firstname}
                  onChange={(e) => {
                    setFirstname(e.target.value);
                  }}
                />
              </td>
            </tr>
            <tr>
              <th scope="row">
                <label htmlFor="lastname">Lastname</label>
              </th>
              <td>
                <input
                  id="lastname"
                  name="lastname"
                  className="regular-text"
                  value={lastname}
                  onChange={(e) => {
                    setLastname(e.target.value);
                  }}
                />
              </td>
            </tr>
            <tr>
              <th scope="row">
                <label htmlFor="email">Email</label>
              </th>
              <td>
                <input
                  id="email"
                  name="email"
                  className="regular-text"
                  value={email}
                  onChange={(e) => {
                    setEmail(e.target.value);
                  }}
                />
              </td>
            </tr>
          </tbody>
        </table>
        <p>
          <button type="submit" className="button button-primary">
            {loader}
          </button>
        </p>
      </form>
    </React.Fragment>
  );
};

export default Settings;
