#include "task.hpp"
#include "user.hpp"
#include <sstream>
#include <iomanip>
#include <ctime>

/**
 * @brief Constructs a new Task
 * 
 * Initializes a task with basic information and sets creation time
 */
Task::Task(const std::string& title, const std::string& description, Priority priority)
    : title(title)
    , description(description)
    , priority(priority)
    , status(Status::TODO)
    , created(std::chrono::system_clock::now()) {
    // Generate unique ID (in practice, this should be handled by a database)
    static int nextId = 1;
    id = nextId++;
}

/**
 * @brief Checks if the task is overdue
 * @return true if the task is past its due date
 */
bool Task::isOverdue() const {
    if (status == Status::COMPLETED || status == Status::CANCELLED) {
        return false;
    }
    return std::chrono::system_clock::now() > dueDate;
}

/**
 * @brief Converts priority enum to string representation
 */
std::string Task::getPriorityString() const {
    switch (priority) {
        case Priority::LOW: return "Low";
        case Priority::MEDIUM: return "Medium";
        case Priority::HIGH: return "High";
        case Priority::URGENT: return "Urgent";
        default: return "Unknown";
    }
}

/**
 * @brief Converts status enum to string representation
 */
std::string Task::getStatusString() const {
    switch (status) {
        case Status::TODO: return "To Do";
        case Status::IN_PROGRESS: return "In Progress";
        case Status::COMPLETED: return "Completed";
        case Status::CANCELLED: return "Cancelled";
        default: return "Unknown";
    }
}

/**
 * @brief Formats the due date as a string
 */
std::string Task::getFormattedDueDate() const {
    auto time = std::chrono::system_clock::to_time_t(dueDate);
    std::stringstream ss;
    ss << std::put_time(std::localtime(&time), "%Y-%m-%d %H:%M");
    return ss.str();
}

/**
 * @brief Formats the creation date as a string
 */
std::string Task::getFormattedCreationDate() const {
    auto time = std::chrono::system_clock::to_time_t(created);
    std::stringstream ss;
    ss << std::put_time(std::localtime(&time), "%Y-%m-%d %H:%M");
    return ss.str();
}

/**
 * @brief Serializes the task to a string format
 * Used for saving tasks to file
 */
std::string Task::serialize() const {
    std::stringstream ss;
    ss << id << "|"
       << title << "|"
       << description << "|"
       << static_cast<int>(priority) << "|"
       << static_cast<int>(status) << "|"
       << std::chrono::system_clock::to_time_t(dueDate) << "|"
       << std::chrono::system_clock::to_time_t(created);
    return ss.str();
}

/**
 * @brief Creates a Task object from a serialized string
 * Used for loading tasks from file
 */
Task Task::deserialize(const std::string& data) {
    std::stringstream ss(data);
    std::string token;
    std::vector<std::string> tokens;
    
    while (std::getline(ss, token, '|')) {
        tokens.push_back(token);
    }

    if (tokens.size() != 7) {
        throw std::runtime_error("Invalid task data format");
    }

    Task task(tokens[1], tokens[2], static_cast<Priority>(std::stoi(tokens[3])));
    task.id = std::stoi(tokens[0]);
    task.status = static_cast<Status>(std::stoi(tokens[4]));
    task.dueDate = std::chrono::system_clock::from_time_t(std::stoull(tokens[5]));
    task.created = std::chrono::system_clock::from_time_t(std::stoull(tokens[6]));

    return task;
} 