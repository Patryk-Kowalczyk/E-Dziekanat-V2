import React, { useState, useEffect } from "react";
import "./annoucmentspage.scss";
import { MdUnfoldMore } from "react-icons/md";
import { Link } from "react-router-dom";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";


const Annoucment = ({ data }) => {
    return (
        <div className="annoucmentspage-item">
            <h2>{data.title}</h2>
            <p className="date">{data.date}</p>
            <p className="text">{data.text}</p>
            <Link to={`/student/wiadomosci/${data.id}`}>
                <button className="button primary">
                    <MdUnfoldMore />
                    <p>Więcej</p>
                </button>
            </Link>
        </div>
    );
};

const AnnoucmentPage = () => {
    const [data, setData] = useState(null);

    useEffect(() => {
        const config = {
            headers: header(),
        };
        axios.get(API_URL + "messages", config).then((response) => {
            setData(response.data.message);
        });
    }, []);
    return (
        <div className="annoucmentspage">
            <h1>Wiadomości</h1>
            <div className="annoucmentspage-annoucments">
                {data ? (
                    data.map((annoucment, index) => {
                        return <Annoucment key={index} data={annoucment} />;
                    })
                ) : (
                    <h3>Jeszcze nie ma żadnych wiadomości</h3>
                )}
            </div>
        </div>
    );
};

export default function index(props) {
    return <AnnoucmentPage {...props} />;
}
