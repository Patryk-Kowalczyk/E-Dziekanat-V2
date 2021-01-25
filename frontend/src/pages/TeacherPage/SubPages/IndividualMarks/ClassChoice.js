import React, {useEffect, useState,createContext,useContext} from 'react';
import "./individualmarks.scss";
import SelectedTable from "./SelectedTable";
import {useDispatch, useSelector} from "react-redux";
import {setClasses} from "../../../../actions/classes";
import axios from "axios";
import API_URL from "../../../../services/API_URL";
import header from "../../../../services/auth-header";
import App from "../../../../App";

export const AppContext = React.createContext([false, () => {}]);


const ClassChoice = () => {
    const dispatch = useDispatch();
    const data = useSelector((state) => state.classes.groups) || [];
    const [selectedOption, choicedSelectedOption] = useState(0);
    const config = {
        headers: header(),
    };

    useEffect(() => {
        axios
            .get(API_URL + "educator/partialGradesList",config)
            .then((response) => {
                const data = response.data;
                console.log(data)
                 dispatch(
                     setClasses({
                       groups: data.groups,
                    }))


            })
            .catch((err) => console.error(err));
    }, [])

    const studentsGroups = [...data].map((item, i) => {
        return (
            <option key={item.id_subject} value={item.id_subject}>
                {item.name} {"----"} {item.form}
            </option>
        )
    })

    const handleChange = (e) => {
        choicedSelectedOption(e.target.value)
    }
    return (
        <>
            <div className="classChoice">
                <form>
                    <select value={selectedOption} onChange={handleChange}>
                        <option value={0}>WYBIERZ GRUPĘ</option>
                        {studentsGroups}
                    </select>
                </form>
            </div>
            <div className="classTable">
                <SelectedTable selected={selectedOption}/>
            </div>
        </>
    );
};

export default ClassChoice;
