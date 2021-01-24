import React, {useState} from 'react';
import "./finalMarks.scss";
import data from "../../endpoints/finalMarks.json";
import {useDispatch, useSelector} from "react-redux";
import {setClasses} from "../../../../actions/classes";
import {setMarks} from "../../../../actions/marks";
import SelectedTable from "./SelectedTable";

const studentsGroups = [...data.groups].map((item, i) => {
    return (
        <option key={item.group_id} value={item.group_id}>
            Grupa: {item.group_id} {"----"} {item.subject} {"----"} {item.form}
        </option>
    )
})

const ClassChoice = () => {
    const dispatch = useDispatch();
    dispatch(
        setMarks({
            groups: data.groups,
        }))

    const [selectedOption, choicedSelectedOption] = useState(0);

    const handleChange = (e) => {
        choicedSelectedOption(e.target.value)
    }
    return (
        <>
            <div className="classChoice">
                <form>
                    <select value={selectedOption} onChange={handleChange}>
                        <option value={0}>WYBIERZ KLASĘ</option>
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
