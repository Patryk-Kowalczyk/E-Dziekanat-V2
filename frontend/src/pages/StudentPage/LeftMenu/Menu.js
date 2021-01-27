import React from "react";
import SingleLink from "./SingleLink";
import {
  MdAccountBalanceWallet,
  MdAssignment,
  MdForum,
  MdList,
  MdCheckCircle,
  MdComputer,
} from "react-icons/md";

import { FaUserGraduate } from "react-icons/fa";

export default function Menu() {
  return (
    <div className="menu">
      <SingleLink
        to="/student/dane-finansowe"
        name="Dane finansowe"
        icon={<MdAccountBalanceWallet />}
      />
      <SingleLink
        to="/student/wiadomosci"
        name="Wiadomości"
        icon={<MdForum />}
      />
      <SingleLink to="/student/ankiety" name="Ankiety" icon={<MdList />} />
      <SingleLink to="/student/wybor" name="Wybór" icon={<MdCheckCircle />} />
      <a
        href="https://e-edukacja.zut.edu.pl/"
        target="_blank"
        rel="noreferrer"
        className="menu__item"
      >
        <MdComputer />
        E-learning
      </a>
      <SingleLink to="/student/uczen" name="Uczeń" icon={<FaUserGraduate />} />
    </div>
  );
}
