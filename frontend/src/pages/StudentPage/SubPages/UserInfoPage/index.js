import React, { useState } from "react";
import "./userinfopage.scss";
import { MdEdit, MdCheck, MdClose } from "react-icons/md";

const data = {
  wydzial: "Informatyki",
  kierunek: "Informatyka",
  specjalizacja: "ISI",
  semestr: 5,
  tel: "123456789",
  email: "mail@mail.to",
};

const UserInfoPage = () => {
  const [isPhoneEdit, setIsPhoneEdit] = useState(false);
  const [isEmailEdit, setIsEmailEdit] = useState(false);
  const [phoneValue, setPhoneValue] = useState(data.tel);
  const [emailValue, setEmailValue] = useState(data.email);
  return (
    <div className="userinfopage">
      <h1>Dane studenta</h1>
      <div className="userinfopage-container">
        <div className="userinfopage-info">
          <p>
            <span>Wydział: </span>
            {data.wydzial}
          </p>
          <p>
            <span>Kierunek: </span>
            {data.kierunek}
          </p>
          <p>
            <span>Specjalizacja: </span>
            {data.specjalizacja}
          </p>
          <p>
            <span>Semestr: </span>
            {data.semestr}
          </p>
        </div>
        <div className="userinfopage-info changable">
          <p>
            <span>Nr. telefonu: </span>
            {!isPhoneEdit ? (
              <>
                {phoneValue}
                <MdEdit
                  className="icon edit"
                  onClick={() => setIsPhoneEdit(!isPhoneEdit)}
                />{" "}
              </>
            ) : (
              <>
                <input
                  type="text"
                  value={phoneValue}
                  onChange={(e) => setPhoneValue(e.target.value)}
                />
                <MdClose
                  className="icon close"
                  onClick={() => {
                    setPhoneValue(data.tel);
                    setIsPhoneEdit(!isPhoneEdit);
                  }}
                />
                <MdCheck
                  className="icon check"
                  onClick={() => {
                    console.log(phoneValue);
                    setIsPhoneEdit(!isPhoneEdit);
                  }}
                />
              </>
            )}
          </p>
          <p>
            <span>Email: </span>
            {!isEmailEdit ? (
              <>
                {emailValue}
                <MdEdit
                  className="icon edit"
                  onClick={() => setIsEmailEdit(!isEmailEdit)}
                />{" "}
              </>
            ) : (
              <>
                <input
                  type="text"
                  value={emailValue}
                  onChange={(e) => setEmailValue(e.target.value)}
                />
                <MdClose
                  className="icon close"
                  onClick={() => {
                    setEmailValue(data.email);
                    setIsEmailEdit(!isEmailEdit);
                  }}
                />
                <MdCheck
                  className="icon check"
                  onClick={() => {
                    console.log(emailValue);
                    setIsEmailEdit(!isEmailEdit);
                  }}
                />
              </>
            )}
          </p>
        </div>
      </div>
    </div>
  );
};

export default function index(props) {
  return <UserInfoPage {...props} />;
}
