import React from "react";
import SingleLink from "./SingleLink";
import {
    MdAccountBalanceWallet,
    MdAssignment,
    MdForum,
    MdList,
    MdSearch,
    MdComputer,
    MdSettings
} from "react-icons/md";
import {FaUserGraduate} from "react-icons/fa";

export default function Menu() {
    return (
        <div className="menu">
            <SingleLink
                to="/educator/dane-finansowe"
                name="Dane finansowe"
                icon={<MdAccountBalanceWallet/>}
            />
            <SingleLink to="/educator/dyplomanci" name="Dyplomanci" icon={<MdAssignment/>}/>
            <SingleLink
                to="/educator/wiadomosci"
                name="Wiadomości"
                icon={<MdForum/>}
            />
            <SingleLink to="/educator/szukaj" name="Szukaj" icon={<MdSearch/>}/>
            <SingleLink
                to="/educator/e-learning"
                name="E-learning"
                icon={<MdComputer/>

                }
                href

            />
            <SingleLink to="/educator/ustawienia" name="Ustawienia" icon={<MdSettings />} />

        </div>
    );
}
