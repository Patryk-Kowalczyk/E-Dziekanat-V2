import React, { useState, useEffect } from "react";
import "./financialdata.scss";
import { useParams } from "react-router-dom";
import axios from "axios";
import header from "../../../../services/auth-header";
import API_URL from "../../../../services/API_URL";

const config = {
    headers: header(),
};

export default function FinancialPayments() {
    const { id } = useParams();
    const [data, setData] = useState(null);

    useEffect(() => {
        axios
            .post(API_URL + "paymentDetails", { payment_id: id }, config)
            .then((response) => {
                setData(response.data.payments);
            })
            .catch(() => {
                window.location = "/student/dane-finansowe";
            });
    }, []);

    return (
        <div className="financialdata">
            <h1>Szczegóły płatności</h1>
            <div className="financialdata-container">
                <table className="primary-table">
                    <thead>
                    <tr>
                        <th colSpan={2}>Przypisane</th>
                        <th colSpan={2}>Wpłaty</th>
                        <th rowSpan={2}>Saldo</th>
                    </tr>
                    <tr>
                        <th>Kwota</th>
                        <th>Data</th>
                        <th>Kwota</th>
                        <th>Data</th>
                    </tr>
                    </thead>
                    <tbody>
                    {data ? (
                        data.map((row) => {
                            return (
                                <tr>
                                    <td>{row.assinged}</td>
                                    <td>{row.assinged_date}</td>
                                    <td>{row.paid}</td>
                                    <td>{row.paid_date}</td>
                                    <td>
                                        {(parseFloat(row.paid) || 0) - parseFloat(row.assinged)}
                                    </td>
                                </tr>
                            );
                        })
                    ) : (
                        <tr className="loading"></tr>
                    )}
                    {data ? (
                        <tr>
                            <td colSpan={2}>
                                {data.reduce((sum, row) => sum + parseFloat(row.assinged), 0)}
                            </td>
                            <td colSpan={2}>
                                {data.reduce(
                                    (sum, row) => sum + parseFloat(row.paid) || 0,
                                    0
                                )}
                            </td>
                            <td>
                                {data.reduce(
                                    (sum, row) =>
                                        sum +
                                        ((parseFloat(row.paid) || 0) - parseFloat(row.assinged)),
                                    0
                                )}
                            </td>
                        </tr>
                    ) : (
                        <div className="loading"></div>
                    )}
                    </tbody>
                </table>
            </div>
        </div>
    );
}
