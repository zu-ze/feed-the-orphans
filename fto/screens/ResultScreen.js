import React, { useState } from "react";
import { View, Text, FlatList} from "react-native";
import { uuid } from "uuidv4";
import Background from "../components/Background";
import ListItem from "../components/ListItem";
import { styles } from "../core/Theme";
import { post } from "../core/Utils";

export const ResultScreen = ({ navigation, route }) => {
    const [json, setJson] = React.useState({});

    React.useEffect(() => {
        if (route.params?.response) {
            setJson(route.params.response)
        }
    })

    const show = (name) => {
        console.log(name);
        navigation.navigate('Profile', route = {
            name: name
        });
    }

    return (
        <Background>
            {/* <View> */}
                {json.status?
                    <View
                        style={[styles.container, {flexDirection: "column", width: "100%", height: '100%'}]}
                    >                     
                    <FlatList
                        style={{width: "100%"}}
                        data={json.records} 
                        renderItem={({item}) => <ListItem item={item} show={show} /> } 
                    />
                    </View>
                :
                    <View
                        style={[styles.container, {flexDirection: "column", width: "100%", height: '100%'}]}
                    >
                        <Text style={[styles.text, {color: "#4b88a2"}]} >{json.message}</Text>
                    </View>
                }
            {/* </View> */}
        </Background>
    )
}