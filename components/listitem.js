import React from 'react';
import {View, Text, StyleSheet, TouchableOpacity} from 'react-native';
// import Icon from 'react-native-vector-icons/dist/FontAwesome'

const ListItem = ({item, show}) => {

  return (
    <TouchableOpacity style={styles.ListItem} onPress={() => show(item.id)}>
        <View style={styles.ListItemView}>
            <Text style={styles.ListItemViewText}>{item.name}</Text>
            {/* <Icon 
                name="remove"
                size={20}
                color="firebrick"
                onPress={() => deleteItem(item.id)}
            /> */}
        </View>
    </TouchableOpacity>
  );
}

const styles = StyleSheet.create({
    ListItem: {
        padding: 15,
        backgroundColor: "#b2e5",
        borderBottomWidth: 1,
        borderBottomColor: "#eee",
        height: 100,
        width: '100%',
        margin: 5,
    },
    ListItemView: {
        flexDirection: "row",
        justifyContent: "space-between",
        alignItems: "center"
    },
    ListItemViewText: {
        fontSize: 18
    }
});

export default ListItem;