import React from "react";
import SingleLink from "./SingleLink";
import {
  MdAccountBalanceWallet,
  MdAssignment,
  MdForum,
  MdList,
  MdCheckCircle,
  MdSearch,
  MdComputer,
} from "react-icons/md";

export default function Menu() {
  return (
    <div className="menu">
      <SingleLink
        to="/dane-finansowe"
        name="Dane finansowe"
        icon={<MdAccountBalanceWallet />}
      />
      <SingleLink to="/dyplom" name="Dyplom" icon={<MdAssignment />} />
      <SingleLink to="/wiadomosci" name="Wiadomości" icon={<MdForum />} />
      <SingleLink
        to="/ankiety-egzaminy"
        name="Ankiety/ Egzaminy"
        icon={<MdList />}
      />
      <SingleLink to="/wybor" name="Wybór" icon={<MdCheckCircle />} />
      <SingleLink to="/szukaj" name="Szukaj" icon={<MdSearch />} />
      <SingleLink to="/e-learning" name="E-learning" icon={<MdComputer />} />
    </div>
  );
}
